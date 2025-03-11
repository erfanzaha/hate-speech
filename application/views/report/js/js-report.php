<script>
$(document).ready(function() {
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        language: {
            paginate: {
                previous: "<i class='uil uil-angle-left'>",
                next: "<i class='uil uil-angle-right'>"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": "<?php echo base_url('view-report'); ?>",
        columns: [{
                data: 'keyword',
                name: 'keyword'
            },
            {
                data: 'link',
                name: 'link'
            },
            {
                data: 'R1',
                name: 'R1'
            },
            {
                data: 'R2',
                name: 'R2'
            },
            {
                data: 'R3',
                name: 'R3'
            },
            {
                data: 'hasil',
                name: 'hasil'
            },
        ]
    });
});
</script>