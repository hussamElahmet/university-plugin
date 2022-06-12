//-----------------------------------------------------------------------------------------------------------------
//areas 

(function ($) {
    
    if ($('#areas').length>0) {
        new SlimSelect({
            select: '#areas',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val()  ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);
//language 
(function ($) {
    if ($('#language').length>0) {
        new SlimSelect({
            select: '#language',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val()  ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);
// branches 
(function ($) {
    
    if ($('#searchBranch').length>0) {
        new SlimSelect({
            select: '#searchBranch',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val() ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
                if (search.length < 2) {
                  callback('Entner three characters at least')
                  return
                }

                $.ajax({
                    type: 'POST',
                    url:mBaseUrl+'/wp-json/university/v1/search_branch/',
                    data: {
                        search_text:search,
                        areas:$('#areas').val(),
                        lang:$('#language').val(),
        
                    },
                    success:function(json) {
                        console.log(json);
                        console.log($('#areas').val());
                        console.log($('#language').val());
                        console.log(search);
                        var data = [];
                        for (let i = 0; i < json.length; i++) {
                            data.push({value:json[i].branch_name,text: json[i].branch_name});
                            callback(data);
                        }
                        console.log("areas=",$('#areas').val());
                        console.log("language=",$('#language').val());
                    },
                    error:function(e){
                        callback(false);
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
        });
    }
    
    

    
})(jQuery);
//degrees
(function ($) {
    if ($('#degrees').length>0) {
        new SlimSelect({
            select: '#degrees',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val() ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);
//citites 
(function ($) {
    if ($('#cities').length>0) {
        new SlimSelect({
            select: '#cities',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val() ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);
//status
(function ($) {
    if ($('#status').length>0) {
        new SlimSelect({
            select: '#status',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val() ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);
//university



(function ($) {
    if ($('#university').length>0) {
        new SlimSelect({
            select: '#university',
            onChange:(info) => {

                if (info.value !='') {
                    $.ajax({
                        type: 'POST',
                        url:mBaseUrl+'/wp-json/university/v1/get_university_related/',
                        data: {
                            areas:$('#areas').val(),
                            lang:$('#language').val(),
                            branch_name:$('#searchBranch').val() ,
                            degrees:$('#degrees').val(),
                            cities:$('#cities').val(),
                            status:$('#status').val(),
                            university:$('#university').val()
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
            // ajax: function (search, callback) {
            //     if (search.length < 2) {
            //       callback('Entner three characters at least')
            //       return
            //     }

            //     $.ajax({
            //         type: 'POST',
            //         url:mBaseUrl+'/wp-json/university/v1/search_branch/',
            //         data: {
            //             search_text:search,
            //             areas:$('#areas').val(),
            //             lang:$('#language').val(),
        
            //         },
            //         success:function(json) {
            //             console.log(json);
            //             console.log($('#areas').val());
            //             console.log($('#language').val());
            //             console.log(search);
            //             var data = [];
            //             for (let i = 0; i < json.length; i++) {
            //                 data.push({value:json[i].branch_name,text: json[i].branch_name});
            //                 callback(data);
            //             }
            //             console.log("areas=",$('#areas').val());
            //             console.log("language=",$('#language').val());
            //         },
            //         error:function(e){
            //             callback(false);
            //             console.log(e);
            //         },
            //         beforeSend: function() {
            //             $('div.loader').css('display','block');
            //         },
            //         complete: function(){
            //             $('div.loader').css('display','none');
            //         }
            //     });   
            // }
        });
    }
})(jQuery);


