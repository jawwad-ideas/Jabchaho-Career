<footer class="p-3 bg-dark text-white ff-gothambook footer">
    <div class="container ">

        <div class="footer-container">
            <div class="footer-col t-a-center">
                <h3 class="tc-yelllow"><img class="logo" src="{{asset('assets/images/jabchaho-logo.svg')}}" /></h3>
                <div class="social-wrapper">
                    <span><a href="#"><img class="social-icn" src="{{asset('assets/images/icons/social/fb_icn.png')}}" /></a></span>
                    <span><a href="#"><img class="social-icn" src="{{asset('assets/images/icons/social/insta_icn.png')}}" /></a></span>
                    <span><a href="#"><img class="social-icn" src="{{asset('assets/images/icons/social/in_icn.png')}}" /></a></span>
                    <span><a href="https://www.youtube.com/@jabchahoofficial"> <img class="social-icn" src="{{asset('assets/images/icons/social/youtube_icn.png')}}" /></a></span>
                </div>
            </div>
            <div class="footer-col t-a-center">
                <h3 class="tc-yelllow">CONTACT US</h3>
                <div class="social-wrapper">
                    <div>UAN Number: 021-111-524-246</div>
                </div>
            </div>
            <div class="footer-col t-a-center">
                <h3 class="tc-yelllow">ADDRESS</h3>
                <div class="social-wrapper">
                    Korangi Industrial Area <br />Karachi City, Sindh, Pakistan
                </div>
            </div>
        </div>
        <div class="text-muted"><p class="copyright">Copyright © {{date('Y')}} Jab Chaho Group. All Rights Reserved.</p></div>
        <div class="ff-gothambook t-a-center">
            @if(!empty($cmsPages))
                @php $counter=1; @endphp
                @foreach($cmsPages as $cmsPage)
                    
                    <a class="px-2 text-white" href="{{route('cms.pages',Arr::get($cmsPage,'url'))}}" target="_blank"/>{{Arr::get($cmsPage,'page')}}</a>  

                    @if(count($cmsPages) != $counter)
                        |
                    @endif
                    @php $counter++; @endphp

                @endforeach
            @endif
        </div>
    </div>

<link href="{!! url('assets/css/select2.min.css') !!}" rel="stylesheet">
<script>
    function select2Fields(fieldClass='', placholder='', url='')
        {
            $('.'+fieldClass).select2({
                placeholder: placholder,
                tags: true,
                minimumInputLength: 2, // only start searching when the user has input 2 or more characters
                maximumInputLength:100,
                tokenSeparators: [';'],
                ajax: {
                    url:url,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.name //save name b/c user can also add some tage
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        } 
</script>

<script src="{!! url('assets/js/select2.min.js') !!}"></script> 

</footer>
