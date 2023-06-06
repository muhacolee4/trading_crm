<script>
    let paymethod = document.querySelector('#paymethod');
    var lastchosen = document.getElementById('lastchosen')

    function checkpamethd(id){
        let url = "{{url('/dashboard/get-method/')}}" + '/' + id;
        fetch(url)
        .then(function(res){
            return res.json();
        })
        .then(function (response){
            paymethod.value = response;
            var paymentchosed = id + 'customCheck1';
            var last = lastchosen.value + 'customCheck1';
           
            if (id === lastchosen.value) {
                document.getElementById(paymentchosed).checked = true;
                lastchosen.value = id;
            }else{
                if (lastchosen.value == 0) {
                    document.getElementById(paymentchosed).checked = true;
                    lastchosen.value = id;
                }else{
                    document.getElementById(last).checked = false;
                    document.getElementById(paymentchosed).checked = true;
                    lastchosen.value = id;
                }
            }
            
            
            $.notify({
                // options
                icon: 'flaticon-alarm-1',
                title: '',
                message: 'you have chosen to pay with ' + ' ' + response,
            },{
                // settings
                type: 'success',
                allow_dismiss: true,
                newest_on_top: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },

            });
        })
        .catch(function(err){
            console.log(err);
        });
    }
    $('#submitpaymentform').on('submit', function() {
        //alert('love');
        if (paymethod.value == "") {
            $.notify({
                // options
                icon: 'flaticon-alarm-1',
                title: '',
                message: 'Please choose a payment method by clicking on it',
            },{
                // settings
                type: 'danger',
                allow_dismiss: true,
                newest_on_top: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },

            });
        }else {
            let makepayurl = "{{url('/dashboard/newdeposit')}}"
            document.getElementById("submitpaymentform").action = makepayurl;
            
        }
        
    });
</script>