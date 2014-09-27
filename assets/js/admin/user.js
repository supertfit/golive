$(document).ready(function() {
    $("a.js-link").click(function(event) {
        event.preventDefault();
        if (confirm('Are you sure?')) {
            window.location.href = $(this).attr('href');
        }
    });
    $("input[name='birthday']").datepicker({'dateFormat' : 'yy-mm-dd'});
    if ($('.datatable').size() != 0) {
        $('.datatable').dataTable({
            "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-12'i><'col-lg-12 center'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "aoColumns": [{
                "bSortable": false
            }, {
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

function onValidate() {
    if (!confirm('Are you sure?')) {
        return false;
    }
    
    if ($("input[name='first_name']").val() == '') {
        alert("Please enter first name.");
        return false;
    }
    
    if ($("input[name='last_name']").val() == '') {
        alert("Please enter first name.");
        return false;
    }
    
    if ($("input[name='email']").val() == '') {
        alert("Please enter Email.");
        return false;
    }    
    
    return true;
}