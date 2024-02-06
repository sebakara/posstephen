@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
    {!! Form::open(['url' => route('business.postRegister'), 'method' => 'post', 
                            'id' => 'business_register_form','files' => true ]) !!}

        @include('business.partials.register_form')
        {!! Form::hidden('package_id', $package_id); !!}
    {!! Form::close() !!}
</div>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
        });

                // TIN Validation
            $('#tin').on('keypress', function(event) {
                var tin = $(this).val();
            // Disable typing if the length is equal to 9
            if (tin.length === 9) {
                event.preventDefault();
                console.log("tin is: "+tin);
                var datapump = {
                            "custmTin": tin
                            };

                    $.ajax({
                    url: '/api/rra_check_bss_details',
                    method: 'POST',
                    data: datapump,
                    success: function(response) {
                        const resdata = response.data.custList
                        console.log(resdata[0]);
                        $('#name').val(resdata[0].taxprNm);
                        $('#city').val(resdata[0].prvncNm);
                        $('#state').val(resdata[0].dstrtNm);
                        $('#country').val('Rwanda');
                        $('#time_zone').val('AAACCC'+getCurrentTime());
                        // city state  country
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }

        });
    })

    function getCurrentTime() {
    var currentDate = new Date();
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();
    var seconds = currentDate.getSeconds();
    // Ensure two-digit format
    hours = (hours < 10 ? '0' : '') + hours;
    minutes = (minutes < 10 ? '0' : '') + minutes;
    seconds = (seconds < 10 ? '0' : '') + seconds;
    // Combine into a 6-digit time format (HHmmss)
    var formattedTime = hours + '' + minutes + '' + seconds;
    return formattedTime;
}
</script>
@endsection