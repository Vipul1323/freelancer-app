<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Freelance Test') }}</title>
</head>

    <body style="font-family: arial; background-color: #F7F7F7; margin: 0px; padding: 0px;">


        <div style="width: 600px; margin:auto; background-color: #F7F7F7; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">

            <div style="width: 100%;padding: 20px 0px;text-align: center;background: #73879C;border-top-left-radius: 0;border-top-right-radius: 0;">
                <div style="font-size: 25px;color:#fff;line-height: 100%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">
                   {{ config('app.name', 'Freelance Test') }}
                </div>
            </div>

            <div style="width: 600px; margin:auto; background-color: #F7F7F7; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">
			    <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
			        <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">
			            Hey <span style="color: #2e2e2e;">{{ ucfirst($receiver) }}</span>, Welcome to {{ config('app.name', 'Freelance Test') }}.
			            <br>
			            Please click on below button to complete your registration process.
			        </div>
			        <div style="width:290px; margin: auto;">
			            <!-- <a href="{{ url('set-password/'.$data['userObj']->remember_token) }}" style="font-size: 16px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #73879C;text-decoration: none; color: #fff;border-radius: 5px;cursor: pointer;display: block;">
			               Set Password
			        </a> -->
			    </div>
			<div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>

        </div>

        <div style="text-align: center; font-size: 12px; color: #707070; line-height: 145%; margin-bottom: 30px;">

            Email sent by <a href="{{ url('') }}" target="_blank" style="text-decoration: none;"><span style="color: #73879C">{{ config('app.name', 'Freelance Test') }}</span></a>

            <br>

            Copyright &copy; {{ date('Y') }} {{ config('app.name', 'Freelance Test') }} - All Rights Reserved.

        </div>

    </div>



</body>

</html>