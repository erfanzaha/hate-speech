<?php
$uri  = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
if($uri2 == 'dashboard'): ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/vendors/css/chartist.min.css">
<?php elseif($uri2 == 'produk' && $uri3 == 'add'): ?>

<?php  endif; ?>