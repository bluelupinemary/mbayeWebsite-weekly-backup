@extends('emails.layouts.app')

@section('content')
<div class="content">
    <td align="left">
        <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">
            <tr>
                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <!-- section text ======-->

                    <div class="trix-content">
                        {!! nl2br($content) !!}
                    </div>
                    
                    @include('emails.layouts.footer')
                </td>
            </tr>
        </table>
    </td>
</div>
@endsection
                        