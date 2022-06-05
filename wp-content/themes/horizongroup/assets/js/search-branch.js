(function ($) {
    debugger
    if ($('#searchBranch').length>0) {
        new SlimSelect({
            select: '#searchBranch',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            branch_name:info.value,
                           
                        },
                        success:function(json) {
                            console.log(json)
                            $('div.result_wrapper').empty();
                            $('div.result_wrapper').append(json);
                        },
                        error:function(e){
                            console.log(e);
                        },
                        beforeSend: function() {
                            $('div.loader').css('display','block');
                        },
                        complete: function(){
                            $('div.loader').css('display','none');
                        }
                    });  
                }
                

            },
            ajax: function (search, callback) {
                if (search.length < 3) {
                  callback('ادخل ثلاث أحرف على الأقل')
                  return
                }

                $.ajax({
                    type: 'POST',
                    url:mBaseUrl+'/wp-json/university/v1/search_branch/',
                    data: {
                        search_text:search
                    },
                    success:function(json) {
                        var data = [];
                        for (let i = 0; i < json.length; i++) {
                            data.push({value:json[i].branch_name,text: json[i].branch_name});
                            callback(data);
                        }
                    },
                    error:function(e){
                        callback(false);
                    },
                    beforeSend: function() {
                        $('div.loader').css('display','block');
                    },
                    complete: function(){
                        $('div.loader').css('display','none');
                    }
                });   
            }
        });
    }
    
    

    
})(jQuery);	
