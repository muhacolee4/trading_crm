<script>
    let destinationasset = document.getElementById('destinationasset');
    let sourceasset = document.getElementById('sourceasset');
    let amount = document.getElementById('amount');
    let quatity = document.getElementById('quantity');
    // console.log(destinationasset);

    destinationasset.addEventListener('change', validate);
    sourceasset.addEventListener('change', validate);
    if (destinationasset.value == sourceasset.value) {
        $.notify({
            // options
            icon: 'flaticon-alarm-1',
            title: '',
            message: 'Source and Destination account cannot be thesame',
        },{
            type: 'danger',
        });
                
        destinationasset.value = '';
        amount.placeholder = '';
        quatity.placeholder = '';
        amount.value = '';
        quatity.value = '';
    } else {
        amount.placeholder = `Enter amount of ${sourceasset.value}`;
        quatity.placeholder = `Quantity of ${destinationasset.value}`;

    }
    function validate(){
        amount.value = '';
        quatity.value = '';
        if (destinationasset.value == sourceasset.value) {
            $.notify({
                // options
                icon: 'flaticon-alarm-1',
                title: '',
                message: 'Source and Destination account cannot be thesame',
            },{
                type: 'danger',
            });
                  
            destinationasset.value = '';
            amount.placeholder = '';
            quatity.placeholder = '';
            amount.value = '';
            quatity.value = '';
        } else {
            amount.placeholder = `Enter amount of ${sourceasset.value}`;
            quatity.placeholder = `Quantity of ${destinationasset.value}`;

        }
    }

    amount.addEventListener('keyup', getQuantity);

    function getQuantity(){
        let uurl = "{{url('/dashboard/asset-price/')}}" + '/' + sourceasset.value  + '/' + destinationasset.value+ '/' + amount.value;
        $.ajax({
            url: uurl,
            type: 'GET',
            
            success: function(response) {
                if (response.status === 200) {
                    //console.log(response.data);
                    quatity.value = response.data + ' ' + destinationasset.value;
                    document.getElementById('realquantity').value = response.data;
                }
            },
            error: function(error) {
                console.log(error);
            },
    
        });
    }

    document.getElementById('exchnageform').addEventListener('submit', exchangeNow)

    function exchangeNow(event) {
        // alert('hey');
        event.preventDefault();
        if (amount.value == '') {
            $.notify({
                // options
                icon: 'flaticon-alarm-1',
                title: '',
                message: 'Please Enter an Amount to Exchange',
            },{
                type: 'danger',
            });
        }else{
            $.ajax({
                url: "{{route('exchangenow')}}",
                type: 'POST',
                data: $('#exchnageform').serialize(),
                success: function(response) {
                    if (response.status === 200) {
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'Success',
                            message: response.success,
                        },{
                            type: 'success',
                        });

                        setTimeout(function(){ window.location.reload(true);}, 3000);
                        
                    } else {
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'Error',
                            message: response.message,
                        },{
                            type: 'danger',
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                },
        
            });
        }
        
    };

    function getcurrbalance() {
        let usdelement = document.querySelectorAll('.usdelement');
        //console.log(usdelement);
        usdelement.forEach(element => {
            let coin = element.id;
            $.ajax({
                url: "{{url('dashboard/balances/')}}" + '/' + coin,
                type: 'GET',
                success: function(response) {
                    element.textContent  = "{{$settings->currency}}" + response.data;
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });
    }
    getcurrbalance();
    setTimeout(function(){getcurrbalance();}, 60000);
    
</script>