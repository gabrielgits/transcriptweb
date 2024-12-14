@extends('landing.layout')

@section('menu')
  <li class="scroll-to-section"><a href="#top" class="active">Inicio</a></li>
  <li class="scroll-to-section"><a href="#services">Funcionalidades</a></li>
  <li class="scroll-to-section"><a href="#about">Sobre o App</a></li>
  <li class="scroll-to-section"><a href="#pricing">Preços</a></li>
  <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
@endsection

@section('content')

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Transcript - Historicos Escolares</h2>
                    <p>Transcript é uma aplicação para gerenciar históricos escolares de estudantes. É uma solução simples e intuitiva que auxilia estudantes e professores no gerenciamento de actividades acadêmicas.</p>
                  </div>
                  <div class="col-lg-12">
                    <div class="white-button scroll-to-section">
                      <a href="https://app.stranscript.online"><img height="50" src="landing/assets/images/button-microsot.png" alt=""></a>
                    </div> 
                    <br>  
                    <br>  
                    <div class="white-button first-button scroll-to-section">
                      <a href="https://app.stranscript.online"><img height="50" src="landing/assets/images/button-app-store.png" alt=""></a>
                    </div>
                    <br>  
                    <br>  
                    <div class="white-button scroll-to-section">
                      <a href="https://play.google.com/store/apps/details?id=ao.gabrielvieira.transcriptapp"><img height="50" src="landing/assets/images/button-play-store.png" alt=""></a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="landing/assets/images/slider-dec.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Funcionalidades do Transcript</h4>
            <img src="landing/assets/images/heading-line-dec.png" alt="">
            <p>Transcript auxilia estudantes e professores no gerenciamento de actividades acadêmicas e geração de históricos escolares.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="service-item first-service">
            <div class="icon"></div>
            <h4>Presenças</h4>
            <p>Acompanhe as suas presenças nas aulas, com a notificação de aulas atrasadas.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Avaliações Diarias</h4>
            <p>Realize avaliações diarias através do aplicativo.</p>
            
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Exames</h4>
            <p>Faça exames e receba o resultado na hora. Indetifique seus pontos fortes e fracos antes de realizar o exame.</p>
            
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item fourth-service">
            <div class="icon"></div>
            <h4>Notas e Relatorios</h4>
            <p>Geração de históricos escolares e relatórios de notas.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="section-heading">
            <h4>Sobre o Transcript</h4>
            <img src="landing/assets/images/heading-line-dec.png" alt="">
            <p>Transcript é um aplicação gratuita e de código aberto hospedada no GitHub. Consulte as paginas dos repositórios do projeto para maiores detalhes do desenvolvimento do aplicativo ou ajudar a melhorar o código.</p>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Backend</a></h4>
                <p>Para desenvolvidores web</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Frontend</a></h4>
                <p>Para desenvolvidores de aplicativos</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Issues Backend</a></h4>
                <p>Em caso de problemas com o backend cria um issue</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Issues Frontend</a></h4>
                <p>Em caso de problemas com o frontend cria um issue</p>
              </div>
            </div>
            <div class="col-lg-12">
              <p>Caso queira contribuir com o desenvolvimento do aplicativo, entre em contato com a equipe.</p>
              <div class="gradient-button">
                <a href="mailto:gabriel.vieira24@outlook.com">Enviar Email</a>
              </div>
              <span>*Disponivel apenas para desenvolvedores.</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="landing/assets/images/about-right-dec.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="clients" class="the-clients">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Níveis de satisfação dos usuários</h4>
            <img src="landing/assets/images/heading-line-dec.png" alt="">
            <p>Veja os níveis de satisfação dos estudantes, professores e administradores de instituições de ensino que usam o aplicativo.</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="grid">
              <div class="row">
                <div class="col-lg-7 align-self-center">
                  <div class="menu">
                    <div class="first-thumb active">
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>David Martino Co</h4>
                            <span class="date">30 November 2021</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Professor</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.8</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Jake Harris Nyo</h4>
                            <span class="date">29 November 2021</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Estudante</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.5</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>May Catherina</h4>
                            <span class="date">27 November 2021</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Director</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.7</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>George Walker</h4>
                            <span class="date">24 November 2021</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Estudante</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">3.9</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="last-thumb">
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Mark Amber Do</h4>
                            <span class="date">21 November 2021</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Estudante</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.3</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="col-lg-5">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="landing/assets/images/quote.png" alt="">
                                <p>“Antes de usar o Transcript, eu tinha problemas em criar e corrigir avaliações. Era muito demorado pelo numero de avaliações. Depois que eu usava o Transcript, o problema foi resolvido.”</p>
                              </div>
                              <div class="down-content">
                                <img src="landing/assets/images/client-image.jpg" alt="">
                                <div class="right-content">
                                  <h4>David Martino</h4>
                                  <span>Professor</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="landing/assets/images/quote.png" alt="">
                                <p>“Transcript me permite saber qual o conteúdo que devo estudar e qual o conteúdo que não deveria estudar.”</p>
                              </div>
                              <div class="down-content">
                                <img src="landing/assets/images/client-image.jpg" alt="">
                                <div class="right-content">
                                  <h4>Jake H. Nyo</h4>
                                  <span>Estudante</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="landing/assets/images/quote.png" alt="">
                                <p>“Os nossos estudantes conseguem ter um melhor entendimento de suas avaliações e notas com o Transcript em qualquer plataforma e qualquer lugar.”</p>
                              </div>
                              <div class="down-content">
                                <img src="landing/assets/images/client-image.jpg" alt="">
                                <div class="right-content">
                                  <h4>May C.</h4>
                                  <span>Director</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="landing/assets/images/quote.png" alt="">
                                <p>“Nada me deirá melhor do que saber exatamente qual é a minha nota em cada avaliação.”</p>
                              </div>
                              <div class="down-content">
                                <img src="landing/assets/images/client-image.jpg" alt="">
                                <div class="right-content">
                                  <h4>Jhon Doe</h4>
                                  <span>Estudante</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="landing/assets/images/quote.png" alt="">
                                <p>“Gostaria de dizer que o Transcript é uma ferramenta muito útil para estudantes e professores.”</p>
                              </div>
                              <div class="down-content">
                                <img src="landing/assets/images/client-image.jpg" alt="">
                                <div class="right-content">
                                  <h4>Mark Am</h4>
                                  <span>Estudante</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>          
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection