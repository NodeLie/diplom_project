$(document).ready(function() 
{    
	$('.delete_button').click(function (data) {
        check = confirm("Вы точно хотите удалить?");
        var id = $(this).attr("data-id");
        var table = $(this).attr("data-table");
        stroke = $(this);
        if (check == true) {
            $.ajax({
                type: "POST",
                url: "/"+table+"/delete",
                data: {'id': id},
                success: function (data) {

                    stroke.parent().parent().remove();

                },
                error: function (xhr) {
                    //console.log(xhr);
                }
            }); 
        }   
    });

function updateFoundation()
{
    $("#id_foundation").empty();
    $("#id_foundation").removeAttr("disabled");
    var id_ppssz = $("#id_ppssz").find("option:selected").val();
    var id_t_cabinet = $("#id_t_cabinet").find("option:selected").val();
    $.ajax({
        type: "POST",
        url: "/passport/ajax-load-foundation",
        data:
        {
            id_ppssz:id_ppssz,
            id_t_cabinet:id_t_cabinet
        },
        success: function (data)
        {
            // обрабатываем полученные данные
            //console.log(data);
            //$(data).insertBefore($(before_class));
            $("#id_foundation").append(data);
            updateAudience();
            updateDiscipline();
            updateInstr();
        },
        error: function (xhr)
        {

        }
    });
}
function updateAudience()
{
    $("#audience").empty();
    $("#audience").removeAttr("disabled");
    var id_foundation = $("#id_foundation").find("option:selected").val();
    $.ajax({
        type: "POST",
        url: "/passport/ajax-load-audience",
        data:
        {
            id_foundation:id_foundation,
        },
        success: function (data)
        {
            // обрабатываем полученные данные
            //console.log(data);
            //$(data).insertBefore($(before_class));
            $("#audience").append(data);
        },
        error: function (xhr)
        {

        }
    });
}
function updateDiscipline()
{
    $("#disciplines").empty();
    $("#disciplines").removeAttr("disabled");
    var id_foundation = $("#id_foundation").find("option:selected").val();
    $.ajax({
        type: "POST",
        url: "/passport/ajax-load-disciplines",
        data:
        {
            id_foundation:id_foundation
        },
        success: function (data)
        {
            // обрабатываем полученные данные
            //console.log(data);
            //$(data).insertBefore($(before_class));
            $("#disciplines").append(data);
        },
        error: function (xhr)
        {

        }
    });
}

function updateInstr()
{
    $("#InstrList").empty();
    var id_foundation = $("#id_foundation").find("option:selected").val();
    $.ajax({
        type: "POST",
        url: "/passport/ajax-load-instr",
        data:
        {
            id_foundation:id_foundation
        },
        success: function (data)
        {
            // обрабатываем полученные данные
            //console.log(data);
            //$(data).insertBefore($(before_class));
            $("#InstrList").append(data);
             $('#id_instr').searchableOptionList();
        },
        error: function (xhr)
        {

        }
    });
}
$('.delete_dop_work').click(function()
{
    check = confirm("Вы точно хотите удалить?");
    var id = $(this).attr("data-id");
    var controller = $(this).attr("data-table");
    stroke = $(this);
    if (check == true)
    {
        $.ajax({
            type: "POST",
            url: "/"+controller+"/delete",
            data: {'id': id},
            success: function (data)
            {
                stroke.parent().parent().remove();
            },
            error: function (xhr)
            {
                //console.log(xhr);
            }
            });
    }
});

$('#add_need_mto').mousedown(function()
{
    $("#need_mto tbody").append("<tr><td><input name='name_need_mto[]' type='text'></td><td><input name='qty_need_mto[]' type='text'></td><td><input name='th_need_mto[]' type='text'></td></tr>");
});

$('#add_need_dop_work').mousedown(function()
{
    $("#need_dop_work tbody").append("<tr><td><input name='name_need_dop_work[]' type='text'></td><td><input name='note_need_dop_work[]' type='text'></td></tr>");
});

$('#add_wear').mousedown(function()
{
    $('#wear tbody').append("<tr><td><input name='name_wear[]' type='text'></td><td><input name='gty_wear[]' type='text'></td></tr>")
});

$('#add_perspect').mousedown(function()
{
    $('#passport_perspect tbody').append("<tr><td><input name='name_perspect[]' type='text'></td><td><input name='qty_perspect[]' type='text'></td><td><input name='description_perspect[]' type='text'></td></tr>")
});

$('#add_dop_work').mousedown(function()
{
    $('#passport_dop_work tbody').append("<tr><td><input name='name_dop_work[]' type='text'></td><td><input name='description_dop_work[]' type='text'></td></tr>")
});

$('#id_ppssz').change(function()
{
    updateFoundation();
});

$('#id_t_cabinet').change(function()
{
    updateFoundation();
});

$('#id_foundation').change(function()
{
    updateAudience();
    updateDiscipline();
    updateInstr();
});
if (window.location.pathname == '/passport/add') {
 updateFoundation();
}

});