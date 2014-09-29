$(document).ready(function() {
    if ($('.datatable').size() != 0) {
        $('.datatable').dataTable({
            "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-12'i><'col-lg-12 center'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "aoColumns": [{
                "bSortable": true
            }, {
                "bSortable": true
            }, {
                "bSortable": true
            }, {
                "bSortable": true
            }, {
                "bSortable": true
            }, {
                "bSortable": false
            }],
            "aaSorting": [[0,'asc']]
        });
    }
});