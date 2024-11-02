$(document).ready(function() 
{
	$("select[multiple='multiple'] option").mousedown(function()
    {
        var $self = $(this);

        if ($self.prop("selected"))
          $self.prop("selected", false);
        else
        $self.prop("selected", true);

   return false;
    });

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

    $("#audience_image").change(function ()
    {
        $("#table_wrapper").empty();
        id = $(this).find("option:selected").val();
        $.ajax({
            type: "POST",
            url: "/roomlayout/get-image",
            data: {
                id:id
            },
            success: function (data)
            {
                // обрабатываем полученные данные
                //console.log(data);
                $("#table_wrapper").append(data);
            },
            error: function (xhr)
            {

            },
        });
    }); 
    function updateFoundation(type)
	{
        if (type == 'filter')
        {
            $("#filtration_form #id_foundation").empty();
            $("#filtration_form #id_foundation").removeAttr("disabled");
            var id_ppssz = $("#filtration_form #ppsz").find("option:selected").val();
            $.ajax({
                type: "POST",
                url: "/user/ajax-load-foundation",
                data:
                {
                    id_ppssz:id_ppssz
                },
                success: function (data)
                {
                    // обрабатываем полученные данные
                    //console.log(data);
                    //$(data).insertBefore($(before_class));
                    $("#filtration_form #id_foundation").append(data);
                },
                error: function (xhr)
                {

                }
            });
        }
        else if(type == 'add')
        {
            $("#add_data_table_form #id_foundation").empty();
            $("#add_data_table_form #id_foundation").removeAttr("disabled");
            var id_ppssz = $("#add_data_table_form #ppsz").find("option:selected").val();
            $.ajax({
                type: "POST",
                url: "/user/ajax-load-foundation",
                data:
                {
                    id_ppssz:id_ppssz
                },
                success: function (data)
                {
                    // обрабатываем полученные данные
                    //console.log(data);
                    //$(data).insertBefore($(before_class));
                    $("#add_data_table_form #id_foundation").append(data);
                },
                error: function (xhr)
                {

                }
            });
        }
        else
        {
            $("#add_fgos_instr #id_foundation").empty();
            $("#add_fgos_instr #id_foundation").removeAttr("disabled");
            var id_ppssz = $("#add_fgos_instr #ppsz").find("option:selected").val();
            $.ajax({
                type: "POST",
                url: "/user/ajax-load-foundation",
                data:
                {
                    id_ppssz:id_ppssz
                },
                success: function (data)
                {
                    // обрабатываем полученные данные
                    //console.log(data);
                    //$(data).insertBefore($(before_class));
                    $("#add_fgos_instr #id_foundation").append(data);
                },
                error: function (xhr)
                {

                }
            });
        }
	    
	}

	$('#add_data_table_form #ppsz').change(function()
	{
    	updateFoundation('add');
	});
    
    $('#add_fgos_instr #ppsz').change(function()
    {
        updateFoundation('add_fgos_instr');
    });
    $('#filtration_form #ppsz').change(function()
    {
        updateFoundation('filter');
    });
	$('#add_data_table_form #id_t_cabinet').change(function()
	{
    	getList("id_foundation","foundation_offices_fgos","id_foundation","name","id_ppssz","#add_data_table_form #id_foundation","#add_data_table_form #ppsz");  
	});

	//getList("id_foundation","foundation_offices_fgos","id_foundation","name","id_ppssz","#add_data_table_form #id_foundation","#add_data_table_form #ppsz"); 
});