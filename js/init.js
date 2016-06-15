/**
 * Created by OranL on 2016/6/13.
 */
(function($){
    $(function(){
        $('.button-collapse').sideNav();
    }); // end of document ready
})(jQuery); // end of jQuery name space

$(function() {
    $("#btn-cp").on("click",
        function(){
            var clipboard = new Clipboard('.btn-cp');

            clipboard.on('success', function(e) {
                console.log(e);
                document.getElementById("btn-cp").innerText = "Success";
            });

            clipboard.on('error', function(e) {
                console.log(e);
                document.getElementById("btn-cp").innerText = "Failed";
            });
        }

    )
});

//own Functions
$(function() {
    $("#shortenLink").on("click",
        function() {
            $("#btn-cp").addClass("hide").text("Copy!");
            $("#source_url_title").removeClass("hide");
            $("#source_url_label").removeClass("hide");
            $("#shortened_url_title").removeClass("hide");
            $("#shortened_url_label").removeClass("hide").text("Waiting...");
            Materialize.toast("工作中", 2000);

            var source_url = $("#source_url").val();
            var customize_short_url = $("#customize_short_url").val();

            //alert(source_url);
            //alert(customize_short_url);

            $.getJSON(
                'api/shorten.php',
                {
                    su: source_url,
                    csl: customize_short_url
                },
                function(json)
                {
                    $("#source_url_label").text(json.sourceLink);
                    $("#current_time_label").text(json.addTime);
                    $("#source_IP_label").text(json.addIP);

                    if (json.status == "233"){
                        $("#shortened_url_label").text(json.shortenedLink);
                        $("#btn-cp").removeClass("hide");
                        Materialize.toast("成功", 3000);
                    }
                    else if(json.status == "203"){
                        $("#shortened_url_label").text(json.shortenedLink);
                        $("#btn-cp").removeClass("hide");
                        Materialize.toast("失败，错误码: " + json.status, 3000);
                    }
                    else{
                        $("#shortened_url_label").text("Error");
                        $("#btn-cp").addClass("hide");
                        Materialize.toast("失败，错误码: " + json.status, 3000);
                    }
                }
            );
        }
    )
});