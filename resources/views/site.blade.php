    @include('layouts.app')

    <main class="main">
        @include('partials.navbar')
        @if (isset($mainText) && !empty($mainText))
            <section id="hero" class="hero section dark-background">
                <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2>{{ $mainText->title }}</h2>
                            <p>{{ $mainText->text }}</p>
                        </div>
                    </div>
                </div>
            </section>
        @else
        @endif

        @if (isset($about) && !empty($about))
            <section id="about" class="about section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>Sobre Nós</h2>
                </div>
                <div class="container">
                    <div class="row gy-3" style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ 'storage/' . $about->image }}" alt="{{ $about->name }}" width="350"
                                class="img-fluid">
                        </div>

                        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="about-content ps-0 ps-lg-3">
                                <h3>{{ $about->title }}</h3>
                                <p>{{ $about->description }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @else
        @endif

        <section id="gallery" class="gallery section">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ url('/images/img1.jpeg') }}" alt="Descrição da imagem"
                            class="img-fluid gallery-img" />
                    </div>
                    <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ url('/images/img2.jpeg') }}" alt="Descrição da imagem"
                            class="img-fluid gallery-img" />
                    </div>
                    <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ url('/images/img3.jpeg') }}" alt="Descrição da imagem"
                            class="img-fluid gallery-img" />
                    </div>
                    <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ url('/images/img4.jpeg') }}" alt="Descrição da imagem"
                            class="img-fluid gallery-img" />
                    </div>
                </div>
            </div>
        </section>

        <!-- CAROUSEL -->
        @if (isset($carousels) && $carousels->isNotEmpty())
            <section class="empresa" style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="container carousel-container">
                    <div class="d-flex justify-content-center my-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true"
                            style="max-width: 800px;">
                            <div class="carousel-indicators">
                                @foreach ($carousels as $index => $carousel)
                                    <button
                                        style="background-color: #333; width: 14px; height: 14px; border-radius: 100%;"
                                        type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($carousels as $index => $carousel)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $carousel->image) }}" style="width: 550px;"
                                            class="d-block h-40 mb-4" alt="...">
                                        @if ($carousel->title || $carousel->description || $carousel->url_link || $carousel->name_link)
                                            <div class="carousel-caption d-md-block"
                                                style="background-color: #333; border-radius: 10px; opacity : 0.7;">
                                                <h5 style="color: #fff;">{{ $carousel->title }}</h5>
                                                <p>{{ $carousel->description }}</p>
                                                <a style="color: #fff;" href="{{ $carousel->url_link }}"
                                                    target="_blank">{{ $carousel->name_link }}</a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span style="background-color: #3498db; border-radius: 100%;"
                                    class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span style="background-color: #3498db; border-radius: 100%;"
                                    class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @else
        @endif
        <!-- END CAROUSEL -->
    </main>
    <footer id="footer" class="footer light-background">
        <div class="container footer-top">
            <div class="row">

                <div class="col-sm footer-about">
                    <h4>Siga-nos</h4>
                    <div class="social-links d-flex mt-4">
                        @foreach ($socialmedias as $media)
                            <a target="_blank" href="{{ $media->url }}">
                                <i class="{{ $media->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm footer-links">
                    <ul>
                        <li><a href="{{ route('index.site') }}">Início</a></li>
                        <li><a href="{{ route('about') }}">Sobre</a></li>
                        <li><a href="{{ route('contact') }}">Contato</a></li>
                        <li><a href="{{ route('login') }}">Área Restrita</a>
                    </ul>
                </div>

                @if (isset($contact) && $contact)
                    <div class="col-sm footer-contact">
                        <h4>Contato</h4>
                        <p>{{ $contact->address }}</p>
                        <p>{{ $contact->city }}/{{ $contact->state }}</p>
                        <p>{{ $contact->zipcode }}</p>
                        <p class="mt-4"><strong>Telefone:</strong> <span>{{ $contact->phone }}</span></p>
                        <p><strong>Email:</strong> <span>{{ $contact->email }}</span></p>
                    </div>
                @else
                @endif
            </div>
        </div>
    </footer>
    <div class="container copyright text-center mt-4">
        <p>Desenvolvido por <a style="font-size: large;" href="https://www.linkedin.com/in/yuri-alec-3976b227/"
                target="_blank"><i class="bi bi-linkedin"></i></a></p>
    </div>

    <style>
        /* Estilo para as imagens da galeria */
        .gallery .img-fluid {
            border-radius: 10px;
            transition: transform 0.3s ease;
            max-width: 100%;
            height: auto;
        }

        /* Efeito de hover para imagens */
        .gallery .img-fluid:hover {
            transform: scale(1.05);
        }

        /* Ajuste para centralizar as imagens */
        .gallery .col-12 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            /* Espaçamento entre as imagens */
        }

        /* Classe personalizada para definir o tamanho ideal das imagens */
        .gallery-img {
            max-width: 100%;
            width: 80%;
            /* Ajuste a largura das imagens para ficarem maiores */
            height: 400px;
            /* Ajuste a altura das imagens para ficarem maiores */
            object-fit: cover;
            /* Faz com que a imagem cubra o espaço disponível sem distorcer */
        }
    </style>
