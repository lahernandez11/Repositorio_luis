$(document).ready(function(){
	
	user=$("input#user").val();
	server=$("input#server").val();
		
	//muestra div atlacomulco
	$("select#proyecto").change(function(){
		proyecto=$(this).val();	
		if(proyecto==00){
			alert("por favor seleccione un proyecto.");
		}	
		else{
			loadTable(proyecto,user,server);
		}
	});	
});

function loadTable(proyecto,user,server)
{
	$.getJSON(base_url+'sgwc/siap/carga_estandares',function(json){
		$("#grid").igGrid({
                width: '100%',
                columns: [		    	    				
					{ headerText: "ACCION", key: "codeID", dataType: "string", width: "30%",
					//template:"<a href='http://ns5002111.ip-192-99-17.net/sgwc_repins/dev_atm_rep_ins_vis.php?id=${codeID}'>Reporte Inpeccion Visual</a>" 
					template:"<a href='http://ns5002111.ip-192-99-17.net/sgwc_repins/dev_atm_rep_ins_vis1.php?id=${codeID}&user="+user+"&server="+server+"'>Reporte Inpeccion Visual</a>" 
					}							
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: json,
    			features: [
					{
                        name: "Resizing"
                    },
				    {
                        name: "Sorting",
                        type: "local",
                        mode: "multi"
                    },
                    {
                        name: "Filtering",
                        type: "local",
                        mode: "advanced"
                    },
                    {
                        name: "Hiding"
                    },
					{
                        name: "Paging",
                        type: "local",
                        pageSize: 10,
						pageSizeList : [10, 20, 50, 100, 500, 1000]
                    },
                    {
                        name: "ColumnMoving"
                    },					
					{
                        name: "Selection"
                    }
                ]
            });	
	});
}
