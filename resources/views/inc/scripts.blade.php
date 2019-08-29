<script src="{{asset('js/all.js')}}"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script language="javascript">
    var clock = 0;
    var interval_msec = 1000;
    var AftTimeZone = 270; // minutes

    // ready
    $(function() {
        // set timer
        clock = setTimeout("UpdateClock()", interval_msec);
    });

    // UpdateClock
    function UpdateClock(){

        // clear timer
        clearTimeout(clock);

        var dt_now = new Date();
        var hh	= dt_now.getHours();
        var mm	= dt_now.getMinutes() + dt_now.getTimezoneOffset() + AftTimeZone;
        var ss	= dt_now.getSeconds();

        if(mm > 60){
            hh = hh + parseInt(mm/60);
            mm = mm - parseInt(mm/60)*60;
        }
        if(hh > 23) {
            hh = hh - 24;
        }
        if(hh < 10){
            hh = "0" + hh;
        }
        if(mm < 10){
            mm = "0" + mm;
        }
        if(ss < 10){
            ss = "0" + ss;
        }
        $(".myclock").html( hh + ":" + mm + ":" + ss);

        // set timer
        clock = setTimeout("UpdateClock()", interval_msec);

    }
</script>


 
<script type="text/javascript">
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
 
    $('form').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[name=list]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
            window.location.href = "/settings/list";
        }
    });
     
    })();
</script>