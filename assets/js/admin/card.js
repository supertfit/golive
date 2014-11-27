$(document).ready(function() {
    $("a.js-link").click(function(event) {
        event.preventDefault();
        if (confirm('Are you sure?')) {
            window.location.href = $(this).attr('href');
        }
    });
    
    $("#tourist_category_id").change(function() {
        $.ajax({
            url: "/backend/admin/touristcategory/sub_all",
            dataType : "json",
            type : "POST",
            data : { cid : $(this).val() },
            success : function(data){
                var str_sub_category = "<option value=''>Select the subcategory.</option>";
                for (var i = 0 ; i < data.length; i++) {
                    str_sub_category += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#tourist_subcategory_id").html(str_sub_category);                
            }
        });
        
    });
    
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
            "aaSorting": [[6,'desc']]
        });
    }
});

function onValidate() {
    if (!confirm('Are you sure?')) {
        return false;
    }
    
    if ($("select[name='name']").val() == '') {
        alert("Please enter Name.");
        return false;
    }
    
    if ($("#tourist_category_id").val() == '') {
        alert("Please select category.");
        return false;
    }
    
    if ($("#tourist_subcategory_id").val() == '') {
        alert("Please select subcategory.");
        return false;
    }
    
    return true;
}

function onConfirm() {
    if (!confirm('Are you sure?')) {
        return false;
    }
    
    return true;
}