
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');


    //pending-order event
    channel.bind('pending-order', function(data) {

        $('#pending-order-flag').show();
        var sound = new Audio("{{asset('js/cartoon-telephone_daniel_simion.mp3')}}");
        sound.play();

        var routeName = '{{request()->route()->getName()}}';
        var col = '<div class="col-lg-4 col-sm-4" id="removable'+data.id+'">';

        if(routeName === 'orders.dashboard')
        {
            col = '<div class="col-lg-6 col-sm-6" id="removable'+data.id+'">';
        }

        $('#pending-order-alert-danger').remove();
        $('#new-orders').prepend($(col + data.order + '</div>').hide().fadeIn(2000));

        toastr.options.positionClass = "toast-bottom-left";
        toastr.options.closeButton = true;
        toastr.options.rtl = true;
        toastr.options.timeOut = 50000;
        toastr.options.onclick = function() {
            window.location = '{{url('admin/orders/')}}/' + data.id;
        };
        toastr.warning('<h3 style="text-align: center">يوجد طلب جديد </h3>');
    });


    //bad-order event
    channel.bind('bad-order', function(data) {

        $('#bad-order-flag').show();
        var sound = new Audio("{{asset('js/sharp.mp3')}}");
        sound.play();

        var routeName = '{{request()->route()->getName()}}';
        var col = '<div class="col-lg-4 col-sm-4" id="removable'+data.id+'">';

        if(routeName === 'orders.dashboard')
        {
            col = '<div class="col-lg-12 col-sm-12" id="removable'+data.id+'">';
        }

        var element = $("#removable" + data.id);

        if(element.length) {

            element.remove().fadeOut('slow');
        }

        $('#bad-order-alert-danger').hide();
        $('#bad-orders').prepend($(col + data.order + '</div>').hide().fadeIn(2000));

        toastr.options.positionClass = "toast-bottom-left";
        toastr.options.closeButton = true;
        toastr.options.rtl = true;
        toastr.options.timeOut = 50000;
        toastr.options.onclick = function() {
            window.location = '{{url('admin/orders')}}/' + data.id;
        };
        toastr.error('<h3 style="float: left"> الطلب <span> #'+ data.id +'</span> به مشكلة </h3>');
    });
</script>