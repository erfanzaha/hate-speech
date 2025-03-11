<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_data_training extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function prosesdeteksi()
    {
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $stringOriginal = strip_tags(trim($this->input->post('opini', 'true')));
        $casefolding = trim($this->input->post('casefolding', 'true'));
        $link = trim($this->input->post('link', 'true'));

        // case folding proses
        if ($casefolding == "lowercase") {
            $stringOriginal = strtolower($stringOriginal);
            //$pembobotan = array_filter(explode(".", strtolower($string2)));
        } else {
            $stringOriginal = strtoupper($stringOriginal);
            //$pembobotan = array_filter(explode(".", strtoupper($string2)));
        }

        $string = str_replace(array('[', ']'), '', $stringOriginal);
        // $string = preg_replace('/[.*]/U', '', $string);
        // $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '', $string);
        // $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '1', $string);
        // $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , ' ', $string);

        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\r", ' ', $string);
        $string = str_replace("(", ' ', $string);
        $string = str_replace(")", ' ', $string);
        $string = str_replace("/", '', $string);
        $string = str_replace("?", '', $string);
        $string = str_replace("!", '', $string);
        $string = str_replace("@", '', $string);
        $string = str_replace("-", '', $string);
        $string = str_replace(",", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace('.', '', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace("‘", '', $string);
        $string = str_replace("”", '', $string);
        $string = str_replace("“", '', $string);
        $string = str_replace("*", '', $string);
        $string = str_replace("_", '', $string);
        $string = str_replace(":", '', $string);
        $string = str_replace("#", '', $string);
        // $string = preg_replace('/ ([\'"()*),.:…;?`\n]) /', '', $string);
        // $string = preg_replace('/ +/', ' ', $string);
        $string = explode(" ", $string);
        $kalimat = $string;

        $afterClear = str_replace(array('[', ']'), '', $stringOriginal);

        // $afterClear = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '', $afterClear);
        // $afterClear = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '1', $afterClear);
        $afterClear = str_replace("\n", ' ', $afterClear);
        $afterClear = str_replace("\r", ' ', $afterClear);
        $afterClear = str_replace("(", ' ', $afterClear);
        $afterClear = str_replace(")", ' ', $afterClear);
        $afterClear = str_replace("/", '', $afterClear);
        $afterClear = str_replace("?", '', $afterClear);
        $afterClear = str_replace("!", '', $afterClear);
        $afterClear = str_replace("@", '', $afterClear);
        $afterClear = str_replace("-", '', $afterClear);
        $afterClear = str_replace(",", '', $afterClear);
        $afterClear = str_replace('"', '', $afterClear);
        $afterClear = str_replace("'", '', $afterClear);
        $afterClear = str_replace("‘", '', $afterClear);
        $afterClear = str_replace("”", '', $afterClear);
        $afterClear = str_replace("“", '', $afterClear);
        $afterClear = str_replace("*", '', $afterClear);
        $afterClear = str_replace("_", '', $afterClear);
        $afterClear = str_replace(":", '', $afterClear);
        $afterClear = str_replace("#", '', $afterClear);
        // $afterClear = preg_replace('/ ([\'"()*),.:…;?`\n]) /', '', $afterClear);
        // $afterClear = preg_replace('/ +/', ' ', $afterClear);

        $output = [];
        foreach ($kalimat as $key => $value) {
            // stopwords
            $list = $this->db->get_where("stopwords", ['kata' => $kalimat[$key]]);

            if ($list->num_rows() <= 0) {
                $kata = $kalimat[$key];

                //stemming
                $kata = $this->m_stemming->hapuspartikel($kata);
                $kata = $this->m_stemming->hapuspp($kata);
                $kata = $this->m_stemming->hapusawalan1($kata);
                $kata = $this->m_stemming->hapusawalan2($kata);
                $kata = $this->m_stemming->hapusakhiran($kata);

                // //insert into word bank
                $checkData = $this->db->get_where('words_bank', ['kata' => $kata])->num_rows();
                if ($checkData <= 0) {
                    if (preg_match('#^http(.*)#', $value['kata'])===0 && preg_match('#^https(.*)#', $value['kata'])===0) {
                        $this->db->insert('words_bank', [
                            'kata' => $kata,
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ]);
                    }
                }

            } else {
                $kata = null;
            }
            $set = [$kata];
            $data = implode(" ", $set);
            array_push($output, $data);
        }

        $word = array_filter($output, function ($var) {
            return ($var != '');
        });

        $original = array_filter(explode(".", $afterClear), function ($value) {
            return ($value != '');
        });

        $l = 0;
        $table1 = array();
        $search = array();

        // generate random character
/*        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kodeberita = substr(str_shuffle($permitted_chars), 0, 16); */

        //pembobotan
        foreach ($output as $key) {
            if (array_search(trim($key), $search) === false) {
                $dok = 0;
                $table1[$l]['kata'] = trim($key);
                $table1[$l]['dok'] = array();

                if (strlen($table1[$l]['kata']) > 1) {
                    if (!empty($table1[$l]['kata'])) {
                        foreach ($original as $key1) {
                            array_push($table1[$l]['dok'], substr_count(trim($key1), trim($key)));
                            ++$dok;
                        }

                        $table1[$l]['df'] = array_sum($table1[$l]['dok']);
                        if ($table1[$l]['df'] > 0) {
                            $table1[$l]['Ddf'] = count($table1[$l]['dok']) / $table1[$l]['df'];
                            $table1[$l]['idf'] = round(log10($table1[$l]['Ddf']), 3);
                        } else {
                            $table1[$l]['Ddf'] = 0;
                            $table1[$l]['idf'] = 0;
                        }

                    }
                    ++$l;
                }
                array_push($search, trim($key));
            }
        }

        foreach ($table1 as $key => $value) {
            if(!empty($value['kata'])){
            $cekData  = $this->db->get_where('tf_idf',['kata'=>$value['kata']]);
            $datalama = $cekData->row();
              if($cekData->num_rows() > 0 ){
                if (preg_match('#^http(.*)#', $value['kata'])===0 && preg_match('#^https(.*)#', $value['kata'])===0) {
                $this->db->where(['kata'=>$value['kata']])   
                         ->update('tf_idf',[
                          'bobot'     => $datalama->bobot + $value['idf'],
                          'jmlh_mcl'  => $datalama->jmlh_mcl + $value['df'],
                          'updated_at'=> $updated_at,
                          ]);
                     }
              }
              else{
                if (preg_match('#^http(.*)#', $value['kata'])===0 && preg_match('#^https(.*)#', $value['kata'])===0) {
                $this->db->insert('tf_idf',[
                  'kata'      =>$value['kata'],
                  'bobot'     =>$value['idf'],
                  'jmlh_mcl'  =>$value['df'],
                  'created_at'=>$created_at,
                  'updated_at'=>$updated_at]);
                }
              }
            }
        }

/*        foreach ($table1 as $key => $value) {
            //ambil data tf idf
            if (!empty($value['kata'])) {
                $r = $this->db->get_where('tf_idf', ['kata' => $value['kata']]);
                $lama = $r->row();

                if ($r->num_rows() > 0) {
                    //penentuan parameter
                    $bobot_lm = $lama->bobot / 2;
                    $muncul_lm = $lama->jmlh_mcl / 2;

                    //penentuan status
                    if ($value['idf'] > $bobot_lm && $value['df'] > $muncul_lm) {
                        $status = "valid";
                    } else {
                        $status = "hoax";
                    }

                    //penentuan bobot status
                    if ($value['idf'] > $bobot_lm) {
                        $bobot_status = "valid";
                    } else {
                        $bobot_status = "hoax";
                    }

                    //penentuan muncul status
                    if ($value['df'] > $muncul_lm) {
                        $jumlah_muncul_status = "valid";
                    } else {
                        $jumlah_muncul_status = "hoax";
                    }

                    //insert ke atribut
                    $this->db->insert('atribut_pendukung', [
                        'kode_berita' => $kodeberita,
                        'kata' => $value['kata'],
                        'bobot' => $value['idf'],
                        'jumlah_muncul' => $value['df'],
                        'status' => $status,
                        'bobot_status' => $bobot_status,
                        'jumlah_muncul_status' => $jumlah_muncul_status,
                    ]);
                }
            }
        }

        //jumlah kasus
        $bobot_lebih = $this->db->get_where('atribut_pendukung', ['kode_berita' => $kodeberita, 'bobot_status' => "valid"])->num_rows();
        $bobot_kurang = $this->db->get_where('atribut_pendukung', ['kode_berita' => $kodeberita, 'bobot_status' => "hoax"])->num_rows();
        $muncul_lebih = $this->db->get_where('atribut_pendukung', ['kode_berita' => $kodeberita, 'jumlah_muncul_status' => "valid"])->num_rows();
        $muncul_kurang = $this->db->get_where('atribut_pendukung', ['kode_berita' => $kodeberita, 'jumlah_muncul_status' => "hoax"])->num_rows();

        $bobot_hoax_lebih = $this->db->get_where('atribut_pendukung', ['status' => "hoax", 'bobot_status' => "valid", 'kode_berita' => $kodeberita])->num_rows();
        $bobot_hoax_kurang = $this->db->get_where('atribut_pendukung', ['status' => "hoax", 'bobot_status' => "hoax", 'kode_berita' => $kodeberita])->num_rows();
        $bobot_valid_lebih = $this->db->get_where('atribut_pendukung', ['status' => "valid", 'bobot_status' => "valid", 'kode_berita' => $kodeberita])->num_rows();
        $bobot_valid_kurang = $this->db->get_where('atribut_pendukung', ['status' => "valid", 'bobot_status' => "hoax", 'kode_berita' => $kodeberita])->num_rows();
        $muncul_hoax_lebih = $this->db->get_where('atribut_pendukung', ['status' => "hoax", 'jumlah_muncul_status' => "valid", 'kode_berita' => $kodeberita])->num_rows();
        $muncul_hoax_kurang = $this->db->get_where('atribut_pendukung', ['status' => "hoax", 'jumlah_muncul_status' => "hoax", 'kode_berita' => $kodeberita])->num_rows();
        $muncul_valid_lebih = $this->db->get_where('atribut_pendukung', ['status' => "valid", 'jumlah_muncul_status' => "valid", 'kode_berita' => $kodeberita])->num_rows();
        $muncul_valid_kurang = $this->db->get_where('atribut_pendukung', ['status' => "valid", 'jumlah_muncul_status' => "hoax", 'kode_berita' => $kodeberita])->num_rows();

        //insert ke jumlah kasus
        $this->db->insert('jumlah_kasus', [
            'kode_berita' => $kodeberita,
            'bobot_hoax_lebih' => $bobot_hoax_lebih,
            'bobot_hoax_kurang' => $bobot_hoax_kurang,
            'muncul_hoax_lebih' => $muncul_hoax_lebih,
            'muncul_hoax_kurang' => $muncul_hoax_kurang,
            'bobot_valid_lebih' => $bobot_valid_lebih,
            'bobot_valid_kurang' => $bobot_valid_kurang,
            'muncul_valid_lebih' => $muncul_valid_lebih,
            'muncul_valid_kurang' => $muncul_valid_kurang,
        ]);

        //node_akar
        $jlh_kata = $this->db->get_where('atribut_pendukung', ['kode_berita' => $kodeberita])->num_rows();
        $getDataJumlahKasus = $this->db->get_where('jumlah_kasus', ['kode_berita' => $kodeberita])->row();

        /**
         * perhitungan information gain general dan entropy general
         */
        //information gain general
/*        $jlh_hoax = $this->db->get_where('atribut_pendukung', ['status' => "hoax", 'kode_berita' => $kodeberita])->num_rows();
        $jlh_valid = $this->db->get_where('atribut_pendukung', ['status' => "valid", 'kode_berita' => $kodeberita])->num_rows();
        $gg_negatif = $jlh_hoax / $jlh_kata;
        $gg_positif = $jlh_valid / $jlh_kata;

        //cek value positif
        if ($gg_positif <= 0) {
            $log_gg_positif = 0;
        } else {
            $log_gg_positif = (log($gg_positif, 2));
        }

        //cek value negatif
        if ($gg_negatif <= 0) {
            $log_gg_negatif = 0;
        } else {
            $log_gg_negatif = (log($gg_negatif, 2));
        }
        $gain_general = (-($gg_negatif) * $log_gg_negatif) + (-($gg_positif) * $log_gg_positif); //gain general
        $ent_gen = ($jlh_kata / $jlh_kata) * $gain_general; //entropy general
        /**
         * perhitungan information gain general dan entropy general
         */

        /**
         * perhitungan information gain bobot lebih dan entropy bobot lebih
         */
        //information gain bobot lebih
/*        $bobot_hoax_lebih = $getDataJumlahKasus->bobot_hoax_lebih;
        $bobot_valid_lebih = $getDataJumlahKasus->bobot_valid_lebih;
        $jlh_bobot_lebih = $getDataJumlahKasus->bobot_lebih;
        if ($bobot_hoax_lebih > 0 && $bobot_valid_lebih > 0 && $jlh_bobot_lebih > 0) {
            $gb_negatif_lebih = $bobot_hoax_lebih / $jlh_bobot_lebih;
            $gb_positif_lebih = $bobot_valid_lebih / $jlh_bobot_lebih;

            //cek value negatif
            if ($gb_negatif_lebih <= 0) {
                $log_gb_negatif_lebih = 0;
            } else {
                $log_gb_negatif_lebih = (log($gb_negatif_lebih, 2));
            }

            //cek value positif
            if ($gb_positif_lebih <= 0) {
                $log_gb_positif_lebih = 0;
            } else {
                $log_gb_positif_lebih = (log($gb_positif_lebih, 2));
            }
            $gb_lebih = (-($gb_negatif_lebih) * $log_gb_negatif_lebih) + (-($gb_positif_lebih) * $log_gb_positif_lebih);
        } else {
            $gb_lebih = 0;
        }
        $ent_bot_lbh = ($jlh_bobot_lebih / $jlh_kata) * $gb_lebih;
        /**
         * perhitungan information gain bobot lebih dan entropy bobot lebih
         */

        /**
         * perhitungan information gain bobot kurang dan entropy bobot kurang
         */
        //information gain bobot kurang
/*        $bobot_hoax_kurang = $getDataJumlahKasus->bobot_hoax_kurang;
        $bobot_valid_kurang = $getDataJumlahKasus->bobot_valid_kurang;
        $jlh_bobot_kurang = $getDataJumlahKasus->bobot_kurang;
        if ($bobot_hoax_kurang > 0 && $bobot_valid_kurang > 0 && $jlh_bobot_kurang > 0) {
            $gb_negatif_kurang = $bobot_hoax_kurang / $jlh_bobot_kurang;
            $gb_positif_kurang = $bobot_valid_kurang / $jlh_bobot_kurang;

            //cek value negatif
            if ($gb_negatif_kurang <= 0) {
                $log_negatif_kurang = 0;
            } else {
                $log_negatif_kurang = (log($gb_negatif_kurang, 2));
            }
            $gb_kurang = (-($gb_negatif_kurang) * $log_negatif_kurang) + (-($gb_positif_kurang) * (log($gb_positif_kurang, 2)));
        } else {
            $gb_kurang = 0;
        }
        $ent_bot_krg = ($jlh_bobot_kurang / $jlh_kata) * $gb_kurang;
        $gain_bobot = $ent_gen - ($ent_bot_lbh + $ent_bot_krg); //menghitung gain atribut bobot
        /**
         * perhitungan information gain bobot kurang dan entropy bobot kurang
         */

        /**
         * perhitungan information gain muncul lebih dan entropy muncul lebih
         */
        //information gain muncul lebih
/*        $muncul_hoax_lebih = $getDataJumlahKasus->muncul_hoax_lebih;
        $muncul_valid_lebih = $getDataJumlahKasus->muncul_valid_lebih;
        $jlh_muncul_lebih = $getDataJumlahKasus->muncul_lebih;
        if ($muncul_hoax_lebih > 0 && $muncul_valid_lebih > 0 && $jlh_muncul_lebih > 0) {
            $gm_negatif_lebih = $muncul_hoax_lebih / $jlh_muncul_lebih;
            $gm_positif_lebih = $muncul_valid_lebih / $jlh_muncul_lebih;
            $gm_lebih = (-($gm_negatif_lebih) * (log($gm_negatif_lebih, 2))) + (-($gm_positif_lebih) * (log($gm_positif_lebih, 2)));
        } else {
            $gm_lebih = 0;
        }
        $ent_mun_lbh = ($jlh_muncul_lebih / $jlh_kata) * $gm_lebih;
        /**
         * perhitungan information gain muncul lebih dan entropy muncul lebih
         */

        /**
         * perhitungan information gain muncul kurang dan entropy muncul kurang
         */
        //information gain muncul kurang
/*        $muncul_hoax_kurang = $getDataJumlahKasus->muncul_hoax_kurang;
        $muncul_valid_kurang = $getDataJumlahKasus->muncul_valid_kurang;
        $jlh_muncul_kurang = $getDataJumlahKasus->muncul_kurang;
        if ($muncul_hoax_kurang > 0 && $muncul_valid_kurang > 0 && $jlh_muncul_kurang > 0) {
            $gm_negatif_kurang = $muncul_hoax_kurang / $jlh_muncul_kurang;
            $gm_positif_kurang = $muncul_valid_kurang / $jlh_muncul_kurang;
            $gm_kurang = (-($gm_negatif_kurang) * (log($gm_negatif_kurang, 2))) + (-($gm_positif_kurang) * (log($gm_positif_kurang, 2)));
        } else {
            $gm_kurang = 0;
        }
        $ent_mun_krg = ($jlh_muncul_kurang / $jlh_kata) * $gm_kurang;
        $gain_muncul = $ent_gen - ($ent_mun_lbh + $ent_mun_krg); //menghitung gain atribut muncul
        /**
         * perhitungan information gain muncul kurang dan entropy muncul kurang
         */

/*        $ig_bobot = $gb_kurang + $gb_lebih;
        $ig_muncul = $gm_kurang + $gm_kurang;
        $ent_bot = $ent_bot_krg + $ent_bot_lbh;
        $ent_mun = $ent_mun_krg + $ent_bot_lbh;

        //insert node_akar
        $this->db->insert('node_akar', [
            'kode_berita' => $kodeberita,
            'bobot_information_gain' => $ig_bobot,
            'bobot_entropy_atribut' => $ent_bot,
            'bobot_gain' => $gain_bobot,
            'muncul_information_gain' => $ig_muncul,
            'muncul_entropy_atribut' => $ent_mun,
            'muncul_gain' => $gain_muncul,
        ]);

        /**
         * desicion tree
         */

/*        if ($gain_bobot > $gain_muncul) {
            $node_akar = "bobot";
        } else {
            $node_akar = "jumlah muncul";
        }

        if ($node_akar == 'bobot') {
            if ($bobot_lebih > $bobot_kurang) {
                $statusBerita = "valid";
            } else {
                if ($muncul_lebih > $muncul_kurang) {
                    $statusBerita = "valid";
                } else {
                    $statusBerita = "hoax";
                }
            }
        } elseif ($node_akar == "jumlah muncul") {
            if ($muncul_lebih > $muncul_kurang) {
                $statusBerita = "valid";
            } else {
                if ($bobot_lebih > $bobot_kurang) {
                    $statusBerita = "valid";
                } else {
                    $statusBerita = "hoax";
                }
            }
        }
*/
        //insert into pre processing        
        $this->db->insert('pre_processing', [
            'news' => implode(" ", $output),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
/*
        $response = [
            'bobot_information_gain' => $ig_bobot,
            'bobot_entropy_atribut' => $ent_bot,
            'bobot_gain' => $gain_bobot,
            'muncul_information_gain' => $ig_muncul,
            'muncul_entropy_atribut' => $ent_mun,
            'muncul_gain' => $gain_muncul,
            'hasil' => $res,
            'gain_general' => $gain_general,
            'ent_gen' => $ent_gen,
        ];
        return $response;
    */
    }

}
