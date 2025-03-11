<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_stemming extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    //=========== stemming v1 ===========//
    public function cekKamus($kata)
    {
        $result = $this->db->get_where('tb_katadasar', ['katadasar' => $kata])
            ->num_rows();

        if ($result == 1) {
            return true; // True jika ada
        } else {
            return false; // jika tidak ada FALSE
        }
    }

    //fungsi untuk menghapus suffix seperti -ku, -mu, -kah, dsb
    public function Del_Inflection_Suffixes($kata)
    {
        $kataAsal = $kata;

        if (preg_match('/([km]u|nya|[kl]ah|pun)\z/i', $kata)) { // Cek Inflection Suffixes
            $__kata = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i', '', $kata);

            return $__kata;
        }
        return $kataAsal;
    }

    // Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
    public function Cek_Prefix_Disallowed_Sufixes($kata)
    {

        if (preg_match('/^(be)[[:alpha:]]+/(i)\z/i', $kata)) { // be- dan -i
            return true;
        }

        if (preg_match('/^(se)[[:alpha:]]+/(i|kan)\z/i', $kata)) { // se- dan -i,-kan
            return true;
        }

        if (preg_match('/^(di)[[:alpha:]]+/(an)\z/i', $kata)) { // di- dan -an
            return true;
        }

        if (preg_match('/^(me)[[:alpha:]]+/(an)\z/i', $kata)) { // me- dan -an
            return true;
        }

        if (preg_match('/^(ke)[[:alpha:]]+/(i|kan)\z/i', $kata)) { // ke- dan -i,-kan
            return true;
        }
        return false;
    }

    // Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
    public function Del_Derivation_Suffixes($kata)
    {
        $kataAsal = $kata;
        if (preg_match('/(i|an)\z/i', $kata)) { // Cek Suffixes
            $__kata = preg_replace('/(i|an)\z/i', '', $kata);
            if ($this->cekKamus($__kata)) { // Cek Kamus
                return $__kata;
            } else if (preg_match('/(kan)\z/i', $kata)) {
                $__kata = preg_replace('/(kan)\z/i', '', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata;
                }
            }
            /*– Jika Tidak ditemukan di kamus –*/
        }
        return $kataAsal;
    }

    // Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
    public function Del_Derivation_Prefix($kata)
    {
        $kataAsal = $kata;

        /* —— Tentukan Tipe Awalan ————*/
        if (preg_match('/^(di|[ks]e)/', $kata)) { // Jika di-,ke-,se-
            $__kata = preg_replace('/^(di|[ks]e)/', '', $kata);

            if ($this->cekKamus($__kata)) {
                return $__kata;
            }

            $__kata__ = $this->Del_Derivation_Suffixes($__kata);

            if ($this->cekKamus($__kata__)) {
                return $__kata__;
            }

            if (preg_match('/^(diper)/', $kata)) { //diper-
                $__kata = preg_replace('/^(diper)/', '', $kata);
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);

                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^(ke[bt]er)/', $kata)) { //keber- dan keter-
                $__kata = preg_replace('/^(ke[bt]er)/', '', $kata);
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);

                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }
        }

        if (preg_match('/^([bt]e)/', $kata)) { //Jika awalannya adalah "te-","ter-", "be-","ber-"

            $__kata = preg_replace('/^([bt]e)/', '', $kata);
            if ($this->cekKamus($__kata)) {
                return $__kata; // Jika ada balik
            }

            $__kata = preg_replace('/^([bt]e[lr])/', '', $kata);
            if ($this->cekKamus($__kata)) {
                return $__kata; // Jika ada balik
            }

            $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            if ($this->cekKamus($__kata__)) {
                return $__kata__;
            }
        }

        if (preg_match('/^([mp]e)/', $kata)) {
            $__kata = preg_replace('/^([mp]e)/', '', $kata);
            if ($this->cekKamus($__kata)) {
                return $__kata; // Jika ada balik
            }
            $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            if ($this->cekKamus($__kata__)) {
                return $__kata__;
            }

            if (preg_match('/^(memper)/', $kata)) {
                $__kata = preg_replace('/^(memper)/', '', $kata);
                if ($this->cekKamus($kata)) {
                    return $__kata;
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^([mp]eng)/', $kata)) {
                $__kata = preg_replace('/^([mp]eng)/', '', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }

                $__kata = preg_replace('/^([mp]eng)/', 'k', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^([mp]eny)/', $kata)) {
                $__kata = preg_replace('/^([mp]eny)/', 's', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^([mp]e[lr])/', $kata)) {
                $__kata = preg_replace('/^([mp]e[lr])/', '', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^([mp]en)/', $kata)) {
                $__kata = preg_replace('/^([mp]en)/', 't', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }

                $__kata = preg_replace('/^([mp]en)/', '', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }

            if (preg_match('/^([mp]em)/', $kata)) {
                $__kata = preg_replace('/^([mp]em)/', '', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }

                $__kata = preg_replace('/^([mp]em)/', 'p', $kata);
                if ($this->cekKamus($__kata)) {
                    return $__kata; // Jika ada balik
                }

                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if ($this->cekKamus($__kata__)) {
                    return $__kata__;
                }
            }
        }
        return $kataAsal;
    }

    public function dataSet($link, $kodeberita)
    {
        $checkData = $this->db->get_where('dataset', ['link' => $link]);
        if ($checkData->num_rows() > 0):
            $getDataset = $checkData->row();
            if ($getDataset->R1 == "Valid"):
                $r1 = 1;
            else:
                $r1 = 0;
            endif;
            if ($getDataset->R2 == "Valid"):
                $r2 = 1;
            else:
                $r2 = 0;
            endif;
            if ($getDataset->R3 == "Valid"):
                $r3 = 1;
            else:
                $r3 = 0;
            endif;

            $r = $r1 + $r2 + $r3;
            if ($r >= 2):
                $res = "valid";
            else:
                $res = "hoax";
            endif;

            $this->db->insert('hasil', [
                'kode_berita' => $kodeberita,
                'link' => $link,
                'hasil' => $res,
            ]);
            return $res;
        else:
            return "Tidak ditemukan didataset";
        endif;
    }
    //=========== stemming v1 ===========//

    //=========== stemming v2 ===========//
    //langkah 1 - hapus partikel
    public function hapuspartikel($kata)
    {
        if ($this->cekKamus($kata) != true) {
            if ((substr($kata, -3) == 'kah') || (substr($kata, -3) == 'lah') || (substr($kata, -3) == 'pun')) {
                $kata = substr($kata, 0, -3);
            }
        }
        return $kata;
    }

    //langkah 2 - hapus possesive pronoun
    public function hapuspp($kata)
    {
        if ($this->cekKamus($kata) != true) {
            if (strlen($kata) > 4) {
                if ((substr($kata, -2) == 'ku') || (substr($kata, -2) == 'mu')) {
                    $kata = substr($kata, 0, -2);
                } else if ((substr($kata, -3) == 'nya')) {
                    $kata = substr($kata, 0, -3);
                }
            }
        }
        return $kata;
    }

    //langkah 3 hapus first order prefiks (awalan pertama)
    public function hapusawalan1($kata)
    {
        if ($this->cekKamus($kata) != true) {

            if (substr($kata, 0, 4) == "meng") {
                if (substr($kata, 4, 1) == "e" || substr($kata, 4, 1) == "u") {
                    $kata = "k" . substr($kata, 4);
                } else {
                    $kata = substr($kata, 4);
                }
            } else if (substr($kata, 0, 4) == "meny") {
                $kata = "s" . substr($kata, 4);
            } else if (substr($kata, 0, 3) == "men") {
                $kata = substr($kata, 3);
            }
            else if (substr($kata, 0, 3) == "mem") {
                if (substr($kata, 3, 1) == "a") {
                    $kata = "m" . substr($kata, 3);
                } else if (substr($kata, 3, 2) == "in") {
                    $kata = "m" . substr($kata, 3);
                } else if (substr($kata, 3, 1) == "i") {
                    $kata = "p" . substr($kata, 3);
                } else {
                    $kata = substr($kata, 3);
                }
            } else if (substr($kata, 0, 2) == "me") {
                $kata = substr($kata, 2);
            } else if (substr($kata, 0, 4) == "peng") {
                if (substr($kata, 4, 1) == "e" || substr($kata, 4, 1) == "a") {
                    $kata = "k" . substr($kata, 4);
                } else {
                    $kata = substr($kata, 4);
                }
            } else if (substr($kata, 0, 4) == "peny") {
                $kata = "s" . substr($kata, 4);
            } else if (substr($kata, 0, 3) == "pen") {
                if (substr($kata, 3, 1) == "a" || substr($kata, 3, 1) == "i" || substr($kata, 3, 1) == "e" || substr($kata, 3, 1) == "u" || substr($kata, 3, 1) == "o") {
                    $kata = "t" . substr($kata, 3);
                } else {
                    $kata = substr($kata, 3);
                }
            } else if (substr($kata, 0, 3) == "pem") {
                if (substr($kata, 3, 1) == "a" || substr($kata, 3, 1) == "i" || substr($kata, 3, 1) == "e" || substr($kata, 3, 1) == "u" || substr($kata, 3, 1) == "o") {
                    $kata = "p" . substr($kata, 3);
                } else {
                    $kata = substr($kata, 3);
                }
            } else if (substr($kata, 0, 2) == "di") {
                $kata = substr($kata, 2);
            } else if (substr($kata, 0, 3) == "ter") {
                $kata = substr($kata, 3);
            } else if (substr($kata, 0, 2) == "ke") {
                $kata = substr($kata, 2);
            }
        }
        return $kata;
    }
    //langkah 4 hapus second order prefiks (awalan kedua)
    public function hapusawalan2($kata)
    {
        if ($this->cekKamus($kata) != true) {

            if (substr($kata, 0, 3) == "ber") {
                $kata = substr($kata, 3);
            } else if (substr($kata, 0, 3) == "bel") {
                $kata = substr($kata, 3);
            } else if (substr($kata, 0, 2) == "be") {
                $kata = substr($kata, 2);
            } else if (substr($kata, 0, 3) == "per" && strlen($kata) > 5) {
                $kata = substr($kata, 3);
            } else if (substr($kata, 0, 2) == "pe" && strlen($kata) > 5) {
                $kata = substr($kata, 2);
            } else if (substr($kata, 0, 3) == "pel" && strlen($kata) > 5) {
                $kata = substr($kata, 3);
            } else if (substr($kata, 0, 2) == "se" && strlen($kata) > 5) {
                $kata = substr($kata, 2);
            }
        }
        return $kata;
    }
    ////langkah 5 hapus suffiks
    public function hapusakhiran($kata)
    {
        if ($this->cekKamus($kata) != true) {

            if (substr($kata, -3) == "kan") {
                $kata = substr($kata, 0, -3);
            } else if (substr($kata, -1) == "i") {
                $kata = substr($kata, 0, -1);
            } else if (substr($kata, -2) == "an") {
                $kata = substr($kata, 0, -2);
            }
        }

        return $kata;
    }
    //=========== stemming v2 ===========//
}
