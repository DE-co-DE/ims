<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script>
 $(function() {
    
						
                                 $('.courseid').change(function(){
                                       let course=$(this).val();
                                          var url= "{{Asset('center/batch/getByCourseId')}}"
                                          $('.batches').html("")
                                                      $('#course_fee').val("")
                                          $.ajax({
                                                type:'post',
                                                url:url,
                                                data:{'courseid':course},
                                                headers: {
                                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function(resp){
                                                            console.log(resp.batches)
                                                      $('.batches').html(resp.batches)
                                                      $('#course_fee').val(resp.fee)
                                                }
                                          })
                                    })
                                  
      
      $('#datepicker').datepicker({dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2019',});
});

$(function() {
      $('#datepicker3').datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true, yearRange: '1940:2019',});
});
  
  $(function() {
      $('#datepicker2').datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true, yearRange: '1940:2019',});
});

$(function() {
      $('datepicker4').datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true, yearRange: '1940:2019',});
});

$(function() {
      $('#datepicker5').datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true, yearRange: '1940:2019',});
});


$(function() {
      $('#datepicker22').datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true, yearRange: '1940:2019',minDate : 0});
});

  </script>
	