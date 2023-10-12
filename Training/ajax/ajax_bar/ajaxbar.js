
    $(document).ready(function(){
        var progressBar=$('#progressBar');
        var color=["red","green","blue"];
        var count=0;
        var interval;
        function changecolor(){
            if(count==3) {
                var col="white";
                progressBar.css('background',col);
                return;
            } else {
                progressBar.css('background',color[count]);
                count=(count+1);
            }
        }

        $('#button').click(function(){
            clearInterval(interval);
            progressBar.css('width','100%');
            $.ajax({
                type:'GET',
                url:'ajaxbar.php',
                success:function(response){
                    interval=setInterval(changecolor,2000);
                    console.log(response);
                },
                error:function(){
                    clearInterval(interval);
                }
            });
        });
    });
    