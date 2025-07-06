<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>

    <div class="container-fluid bg-dark p-0 mb-5">
      <div class="row g-0 flex-column-reverse flex-lg-row">
        <div class="col-lg-6 p-0 wow fadeIn" data-wow-delay="0.1s">
          <div
            class="header-bg h-100 d-flex flex-column justify-content-center p-5"
          >
            <h1 class="display-4 text-light mb-5">
              Venha viver uma aventura jurássica!
            </h1>
            <div class="d-flex align-items-center pt-4 animated slideInDown">
              <a href="" class="btn btn-jurassic py-sm-3 px-3 px-sm-5 me-5">
                Leia mais
              </a>
              <button
                type="button"
                class="btn-play"
                data-bs-toggle="modal"
                data-src="https://www.youtube.com/embed/Q0K90J-B62Y" data-bs-target="#videoModal"
              >
                <span></span>
              </button>
              <h6 class="text-white m-0 ms-4 d-none d-sm-block">Veja mais sobre nosso parque</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
          <div class="owl-carousel header-carousel">
            <div class="owl-carousel-item">
              <img class="img-fluid" src="img/dinossauro_1.jpg" alt="Dinossauro no Jurassic Park" />
            </div>
            <div class="owl-carousel-item">
              <img class="img-fluid" src="img/dinossauro_4.jpg" alt="Dinossauro em paisagem tropical" />
            </div>
            <div class="owl-carousel-item">
              <img class="img-fluid" src="img/dinossauro_3.jpg" alt="Dinossauros em ambiente natural" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal modal-video fade"
      id="videoModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content rounded-0">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Vídeo Promocional</h3>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="ratio ratio-16x9">
              <iframe
                class="embed-responsive-item"
                src=""
                id="video"
                allowfullscreen
                allowscriptaccess="always"
                allow="autoplay"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
            <p><span class="text-primary me-2"></span>Bem-vindo(a) ao Jurassic Park</p>
            <h1 class="display-5 mb-4">
              Por que você deveria visitar o
              <span class="text-primary">parque dos dinossauros</span>?
            </h1>
            <p class="mb-4">
              Viva uma aventura inesquecível no Jurassic Park, onde você poderá ver de perto dinossauros reais em seu habitat natural!
              Explore trilhas emocionantes, atrações interativas e shows ao vivo que combinam ciência e diversão.
              Uma experiência única para toda a família, cheia de emoção e descobertas pré-históricas!
            </p>
            <h5 class="mb-3">
              <i class="far fa-check-circle text-primary me-3"></i>Uma visita ao passado
            </h5>
            <h5 class="mb-3">
              <i class="far fa-check-circle text-primary me-3"></i>Ambiente natural
            </h5>
            <h5 class="mb-3">
              <i class="far fa-check-circle text-primary me-3"></i>Estrutura segura
            </h5>
            <h5 class="mb-3">
              <i class="far fa-check-circle text-primary me-3"></i>Os dinossauros mais incríveis que você vai conhecer!
            </h5>
            <a class="btn btn-jurassic py-3 px-5 mt-3" href="">Leia mais</a>
          </div>
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="img-border">
              <img class="img-fluid" src="img/parque_1.jpg" alt="Visão do Jurassic Park" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="container-xxl bg-primary facts my-5 py-5 wow fadeInUp"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <div class="row g-4">
          <div
            class="col-md-6 col-lg-3 text-center wow fadeIn"
            data-wow-delay="0.1s"
          >
            <i class="fa fa-paw fa-3x text-primary mb-3"></i>
            <h1 class="text-white mb-2" data-toggle="counter-up">500</h1>
            <p class="text-white mb-0">Total de espécies</p>
          </div>
          <div
            class="col-md-6 col-lg-3 text-center wow fadeIn"
            data-wow-delay="0.3s"
          >
            <i class="fa fa-users fa-3x text-primary mb-3"></i>
            <h1 class="text-white mb-2" data-toggle="counter-up">12345</h1>
            <p class="text-white mb-0">Visitantes por dia</p>
          </div>
          <div
            class="col-md-6 col-lg-3 text-center wow fadeIn"
            data-wow-delay="0.5s"
          >
            <i class="fa fa-certificate fa-3x text-primary mb-3"></i>
            <h1 class="text-white mb-2" data-toggle="counter-up">10000</h1>
            <p class="text-white mb-0">Total de acidentes</p>
          </div>
          <div
            class="col-md-6 col-lg-3 text-center wow fadeIn"
            data-wow-delay="0.7s"
          >
            <i class="fa fa-shield-alt fa-3x text-primary mb-3"></i>
            <h1 class="text-white mb-2" data-toggle="counter-up">90</h1>
            <p class="text-white mb-0">Segurança</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
          <div class="col-lg-6">
            <p><span class="text-primary me-2"></span>Nossos serviços</p>
            <h1 class="display-5 mb-0">
              Os melhores serviços
              <span class="text-primary">para nossos visitantes</span>
            </h1>
          </div>
          <div class="col-lg-6">
            <div
              class="bg-primary h-100 d-flex align-items-center py-4 px-4 px-sm-5"
            >
              <i class="fa fa-3x fa-mobile-alt text-white"></i>
              <div class="ms-4">
                <p class="text-white mb-0">Entre em contato para mais informações</p>
                <h2 class="text-white mb-0">+001 120 1990</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row gy-5 gx-4">
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.1s"
          >
            <img class="img-fluid mb-3" src="img/estacionamento.png" alt="Ícone de Estacionamento" />
            <h5 class="mb-3">Estacionamento</h5>
            <span>
              Chegue tranquilo e estacione seu carro em segurança, longe dos dinossauros mais curiosos.
              Nossos guias estarão prontos para te levar a uma aventura inesquecível,
              onde o único "arranhão" será na sua rotina.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.3s"
          >
            <img class="img-fluid mb-3" src="img/camera.png" alt="Ícone de Câmera" />
            <h5 class="mb-3">Fotos</h5>
            <span>
              Capture momentos épicos! Cada clique no Jurassic Park é uma foto espetacular, mas lembre-se:
              segurança em primeiro lugar para você e nossos gigantes pré-históricos.
              Leve para casa memórias incríveis e fotos de tirar o fôlego.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.5s"
          >
            <img class="img-fluid mb-3" src="img/guia.png" alt="Ícone de Guia Turístico" />
            <h5 class="mb-3">Visitas guiadas</h5>
            <span>
              Embarque em nossos veículos seguros e explore o Jurassic Park com guias especializados.
              Descubra os segredos dos dinossauros e viva uma experiência emocionante e inesquecível.
              A aventura espera por você a cada curva!
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.7s"
          >
            <img class="img-fluid mb-3" src="img/comida.png" alt="Ícone de Comida" />
            <h5 class="mb-3">Praça de alimentação</h5>
            <span>
              Após tanta emoção, recarregue as energias em nossa praça de alimentação.
              Deliciosas opções esperam por você em um ambiente descontraído.
              O cheiro é bom, mas esperamos que apenas os clientes se sintam atraídos.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.1s"
          >
            <img class="img-fluid mb-3" src="img/compra.png" alt="Ícone de Sacola de Compras" />
            <h5 class="mb-3">Loja de souvenirs</h5>
            <span>
              Leve a magia do Jurassic Park para casa!
              Nossa loja oferece lembranças incríveis, de pelúcias a réplicas, para todos os fãs de dinossauros.
              Um pedacinho da aventura sempre com você.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.3s"
          >
            <img class="img-fluid mb-3" src="img/area.png" alt="Ícone de Áreas" />
            <h5 class="mb-3">Mais de três áreas imersivas</h5>
            <span>
              Prepare-se para explorar! Mergulhe no Vale dos Braquiossauros, sinta a emoção na Lagoa dos Mosassauros e maravilhe-se no Centro de Visitantes.
              Cada área é uma aventura única esperando por você.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.5s"
          >
            <img class="img-fluid mb-3" src="img/recreacao.png" alt="Ícone de Recreação" />
            <h5 class="mb-3">Recreação</h5>
            <span>
              Para a alegria dos nossos pequenos paleontólogos, temos uma área de recreação segura e fechada!
              Aqui, eles podem explorar jogos temáticos e atividades divertidas, com total tranquilidade para os pais.
            </span>
          </div>
          <div
            class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp"
            data-wow-delay="0.7s"
          >
            <img class="img-fluid mb-3" src="img/estadia.png" alt="Ícone de Estadia" />
            <h5 class="mb-3">Estadia</h5>
            <span>
              Prolongue sua aventura em nossos bangalôs confortáveis com vistas espetaculares.
              Durma embalado pelos sons da natureza e dos dinossauros.
              Uma noite inesquecível te aguarda no coração do Jurassic Park!
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="container-xxl py-5">
      <div class="container">
        <h1
          class="display-5 text-center mb-5 wow fadeInUp"
          data-wow-delay="0.1s"
        >
          Nossos clientes estão dizendo!
        </h1>
        <div
          class="owl-carousel testimonial-carousel wow fadeInUp"
          data-wow-delay="0.1s"
        >
          <div class="testimonial-item text-center">
            <img
              class="img-fluid rounded-circle border border-2 p-2 mx-auto mb-4"
              src="img/testimonial-1.jpg"
              style="width: 100px; height: 100px"
              alt="Foto de Ane Marie"
            />
            <div class="testimonial-text rounded text-center p-4">
              <p>
                Um local super divertido e acolhedor! Apesar do incidente que presenciamos no dia que fomos,
                com certeza voltarei com meus filhos e sobrinhos!
              </p>
              <h5 class="mb-1">Ane Marie</h5>
              <span class="fst-italic">Visitante</span>
            </div>
          </div>
          <div class="testimonial-item text-center">
            <img
              class="img-fluid rounded-circle border border-2 p-2 mx-auto mb-4"
              src="img/testimonial-2.jpg"
              style="width: 100px; height: 100px"
              alt="Foto de Silversval Cara de Pau"
            />
            <div class="testimonial-text rounded text-center p-4">
              <p>
                Um local muito divertido, às vezes algumas falhas acabam acontecendo, mas isso
                não interfere na experiência, voltarei mais vezes.
              </p>
              <h5 class="mb-1">Silversval Cara de Pau</h5>
              <span class="fst-italic">Visitante</span>
            </div>
          </div>
          <div class="testimonial-item text-center">
            <img
              class="img-fluid rounded-circle border border-2 p-2 mx-auto mb-4"
              src="img/testimonial-3.jpg"
              style="width: 100px; height: 100px"
              alt="Foto de Armando Ando"
            />
            <div class="testimonial-text rounded text-center p-4">
              <p>
                No dia em que eu fui estava uma parte interditada, pois o carnotauro havia escapado
                da jaula. Fora isso, tive uma experiência muito divertida, voltarei com meus amigos
                da próxima vez!
              </p>
              <h5 class="mb-1">Armando Ando</h5>
              <span class="fst-italic">Visitante</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="container-fluid footer bg-dark text-light footer mt-5 pt-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Endereço</h5>
            <p class="mb-2">
              <i class="fa fa-map-marker-alt me-3"></i>Isla Nublar, Costa Rica
            </p>
            <p class="mb-2">
              <i class="fa fa-phone-alt me-3"></i>+001 120 1990
            </p>
            <p class="mb-2">
              <i class="fa fa-envelope me-3"></i>ingen_jurassicpark@gmail.com
            </p>
            <div class="d-flex pt-2">
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-twitter"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-youtube"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Links rápidos</h5>
            <a class="btn btn-link" href="">Sobre nós</a>
            <a class="btn btn-link" href="">Entre em contato</a>
            <a class="btn btn-link" href="">Suporte</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Links populares</h5>
            <a class="btn btn-link" href="">Sobre nós</a>
            <a class="btn btn-link" href="">Entre em contato</a>
            <a class="btn btn-link" href="">Nossos serviços</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Notícias</h5>
            <p>Em breve mais informações!</p>
            <div class="position-relative mx-auto" style="max-width: 400px">
              <input
                class="form-control border-0 w-100 py-3 ps-4 pe-5"
                type="text"
                placeholder="Seu email"
              />
              <button
                type="button"
                class="btn btn-jurassic position-absolute top-0 end-0 me-2 mt-2"
                style="height: calc(100% - 16px);"
              >
                Assinar
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              © <a class="border-bottom" href="#">Jurassic Park</a>, Todos os direitos reservados
            </div>
            <div class="col-md-6 text-center text-md-end">
              Designed By
              <a class="border-bottom" href="https://htmlcodex.com"
                >HTML Codex</a
              >
              <br />Distributed By:
              <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="#" class="btn btn-lg btn-jurassic btn-lg-square back-to-top">
      <i class="bi bi-arrow-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>