<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$settings->site_name}}</title>

    <link rel="icon" href="{{asset('front/images/logo1.svg')}}">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carousel.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/global.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/index.css')}}">

</head>

<body>
    <div>
        <div class="small-nav">
            <div class="flex">
                <div>
                    <img class="logo" src="{{asset('front/images/logo2.svg')}}">
                </div>
                <div>
                    <button class="btn zozoz">{{ trans('main.Consultation')}} !</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="zozo">
                        <div>
                            commercial issues
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="zozo">
                        <div>
                            commercial issues
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="zozo">
                        <div>
                            commercial issues
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="zozo">
                        <div>
                            commercial issues
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="header" class="my-flex">
            <!--start top nav-->
            <div class="top-nav flex">
                <div>
                    <img src="{{asset('front/images/logo2.svg')}}">
                </div>
                <div>
                    <button class="btn zozoz">{{ trans('main.Consultation')}} !</button>
                </div>
            </div>
            <!--start home section-->
            <section class="main-content">
                <video autoplay="" muted="" loop="" id="bg-video">
                    <source src="{{asset('front/images/law-video.mp4')}}" type="video/mp4">
                </video>
                <div class="video-overlay header-text">
                    <div class="caption">
                        <img src="{{asset('front/images/logo1.svg')}}">
                        <br>
                        <br>
                        <h2>{{$settings->gettranslation('goal',app()->getLocale())}}</h2>
                        <p>{{$settings->gettranslation('about_us',app()->getLocale())}}</p>
                        <div class="main-button scroll-to-section">
                            <a href="#features" class="btn">{{ trans('main.Join_us')}}</a>
                        </div>
                    </div>
                </div>
            </section>
            <!--start services section-->
            <section class="services">
                <div class="container text-center">
                    <div>
                        <h2 class="sec-tit">{{ trans('main.Our_services')}}</h2>
                        <p class="sec-par">
                            {{$settings->gettranslation('our_services_sub_title',app()->getLocale())}}
                        </p>
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-md-6">
                                    <div>
                                        <div class="ser-img">
                                            <img src="{{asset('front/images/lawicon.svg')}}">
                                        </div>
                                        <div class="ser-content">
                                            <h4>{{$service->gettranslation('title',app()->getLocale())}}</h4>
                                            <p>{{$service->gettranslation('title',app()->getLocale())}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- <br>
                        <br>
                        <h2 class="sec-tit">our goals</h2>
                        <p class="sec-par">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Est enim ipsum molestias aspernatur
                            vel! Dolorum autem accusamus ipsa repellendus esse?
                        </p>
                        <div class="row goals">
                            <div class="col-md-4">
                                <div>
                                    <div class="ser-img">
                                        <img src="assets/images/lawicon.svg">
                                    </div>
                                    <div class="ser-content">
                                        <h4>About justice, we are not fair</h4>
                                        <p>
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim omnis, ullam
                                            nobis repudiandae
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <div class="ser-img">
                                        <img src="assets/images/lawicon.svg">
                                    </div>
                                    <div class="ser-content">
                                        <h4>About justice, we are not fair</h4>
                                        <p>
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim omnis, ullam
                                            nobis repudiandae
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <div class="ser-img">
                                        <img src="assets/images/lawicon.svg">
                                    </div>
                                    <div class="ser-content">
                                        <h4>About justice, we are not fair</h4>
                                        <p>
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim omnis, ullam
                                            nobis repudiandae
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                </div>

            </section>
            <!--start commercial section-->
            <section class="syn commercial" id="commercial">
                <div class="container text-center">
                    <div class="">
                        <h2 class="sec-tit">{{ trans('main.Commercial_issus')}}</h2>
                        <p class="sec-par"> 
                            {{$settings->gettranslation('commercial_issues_sub_title',app()->getLocale())}}
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <h2>+{{$settings->expert_laywers}}</h2>
                                    <h3>{{ trans('main.Expert_laywers')}}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <h2>+{{$settings->closed_cases}}</h2>
                                    <h3>{{ trans('main.Closed_cases')}}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <h2>+{{$settings->successful_casses}}</h2>
                                    <h3>{{ trans('main.Successful_cases')}}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <h2>+{{$settings->trusted_client}}</h2>
                                    <h3>{{ trans('main.Trusted_clients')}}</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!--start team section-->
            <section class="team">
                <div class="container text-center">
                    <div>
                        <h2 class="sec-tit">{{ trans('main.Our_team')}}</h2>
                        <p class="sec-par">
                            {{$settings->gettranslation('commercial_issues_sub_title',app()->getLocale())}}
                        </p>
                        <div class="row">
                            @foreach ($laywers as $laywer)
                                <div class="col-md-3">
                                    <div>
                                        <div class="team-img">
                                            <img src="{{asset($laywer->attachmentRelation->path)}}">
                                        </div>
                                        <div class="team-content">
                                            <div>
                                                <h4>{{$laywer->name}}</h4>
                                                <p>frontend developer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </section>
            <!--start clients section-->
            <section class="clients">
                <div class="container text-center">
                    <div>
                        <h2 class="sec-tit">{{ trans('main.Our_clients')}}</h2>
                        <p class="sec-par">
                            {{$settings->gettranslation('our_clients_sub_title',app()->getLocale())}}
                        </p>
                        <div class="logos">
                            <div class="owl-carousel owl-theme">
                                @foreach ($clients as $client)
                                    <div>
                                        <div>
                                            <img src="{{asset($client->attachmentRelation->path)}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!--start FAQ section-->
            <section class="faq">
                <div class="container text-center">
                    <div>
                        <h2 class="sec-tit">{{ trans('main.Common_questions')}}</h2>
                        <p class="sec-par">
                            {{$settings->gettranslation('faq_sub_title',app()->getLocale())}}
                        </p>
                        <div class="faq-part">
                            <div class="ques">
                                @foreach ($consults as $consult )
                                    <div class="qu">
                                        <h2>{{$consult->question}}</h2>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#fff">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div class="an">
                                        <p>{{$consult->answer}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn addqu">ِAdd Question</button>
                <!--start Add ques section-->
                <div class="consoul">
                    <div class="container text-center">
                        <div>
                            <h2 class="sec-tit">Add question</h2>
                            <form action="">
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <label for="fname">Full name</label>
                                        <input type="text" id="fname" name="fullname" placeholder="Your Name..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Your Email..">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="subject">Your Question</label>
                                        <textarea id="subject" name="subject" placeholder="Write something.."
                                            style="height:200px"></textarea>
                                    </div>
                                </div>
                                <input type="submit" value="Submit" class="btn">
                            </form>

                        </div>
                    </div>
                </div>
            </section>
            <!--start blogs section-->
            <section class="main-content work">
                <div class="flex cen">
                    <div>
                        <h2><span>{{ trans('main.Our_blogs')}}</span></h2>
                        <p>
                            {{$settings->gettranslation('blog_sub_title',app()->getLocale())}}
                        </p>
                    </div>
                    <div class="flex xox">
                        @foreach ($articles as $article)
                            <div style="background-image: url('{{asset($article->attachmentRelation->path)}}')">
                                <div class="moms">
                                    <a href="#">
                                        <h3>{{$article->title}}</h3>
                                        <p>{{$article->content}}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!--start contact section-->
            <section class="contact">
                <div class="container text-center">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54695.308269731664!2d31.347820138609315!3d31.04138142169491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79db7a9053547%3A0xf8dab3bbed766c97!2sMansoura%2C%20Mansoura%20Qism%202%2C%20El%20Mansoura%2C%20Dakahlia%20Governorate!5e0!3m2!1sen!2seg!4v1642575934121!5m2!1sen!2seg"
                                    width="100%" height="100%" style="border:0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>
                            <div class="col-md-6 text-left">
                                <h2 class="sec-tit">{{ trans('main.Contact_us')}}</h2>
                                <form action="{{route('new_contact',app()->getLocale())}}" method="post">
                                    @csrf
                                    <div class="row text-left">
                                        <div class="col-md-6">
                                            <label for="fname">Full name</label>
                                            <input type="text" id="fname" name="full_name" placeholder="Your Name..">
                                            @error('full_name')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Your Email..">
                                            @error('email')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="subject">Your Message</label>
                                            <textarea id="subject" name="message" placeholder="Write something.."
                                                style="height:130px"></textarea>
                                            @error('message')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div>
                                            <ul class="flex">
                                                <li>
                                                    <a href="#">
                                                        <img src="{{asset('front/images/icons/facebook.svg')}}">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{asset('front/images/icons/youtube.svg')}}">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{asset('front/images/icons/twitter.svg')}}">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{asset('front/images/icons/gmail.svg')}}">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <input type="submit" value="{{ trans('main.Send')}}" class="btn">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
        <div class="bottom-nav flex">
            <div>
                <ul class="flex navv">
                    <li class="active">
                        <span>
                            {{ trans('main.Home')}}
                        </span>
                    </li>
                    <li id="About">
                        <span>
                            {{ trans('main.Services')}}
                        </span>
                    </li>
                    <li id="work">
                        <span>
                            {{ trans('main.Commercial')}}
                        </span>
                    </li>
                    <li id="commercial">
                        <span>
                            {{ trans('main.Team')}}
                        </span>
                    </li>
                    <li id="services">
                        <span>
                            {{ trans('main.Clients')}}
                        </span>
                    </li>
                    <li id="Team">
                        <span>
                            {{ trans('main.Faq')}}
                        </span>
                    </li>
                    <li id="clients">
                        <span>
                            {{ trans('main.Blog')}}
                        </span>
                    </li>
                    <li id="faq">
                        <span>
                            {{ trans('main.Contact')}}
                        </span>
                    </li>
                </ul>
            </div>
            <!-- <div>
                <ul class="flex">
                    <li>
                        <a href="#">
                            <img src="assets/images/icons/facebook.svg">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/icons/youtube.svg">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/icons/twitter.svg">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="assets/images/icons/gmail.svg">
                        </a>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>


    </div>
    <!-- jQuery -->
    <script src="{{asset('front/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('front/js/popper.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/index.js')}}"></script>
</body>

</html>