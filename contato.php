<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>

    <div
      class="container-fluid header-bg py-5 mb-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <h1 class="display-4 text-white mb-3 animated slideInDown">
          Entre em contato 
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Paginas</a>
            </li>
            <li class="breadcrumb-item text-primary active" aria-current="page">
              Entre em contato
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-4 mb-5">
          <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="h-100 bg-light d-flex align-items-center p-5">
              <div class="btn-lg-square bg-white flex-shrink-0">
                <i class="fa fa-map-marker-alt text-primary"></i>
              </div>
              <div class="ms-4">
                <p class="mb-2">
                  <span class="text-primary me-2"></span>Endereço
                </p>
                <h5 class="mb-0">Isla Nublar, Costa Rica</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="h-100 bg-light d-flex align-items-center p-5">
              <div class="btn-lg-square bg-white flex-shrink-0">
                <i class="fa fa-phone-alt text-primary"></i>
              </div>
              <div class="ms-4">
                <p class="mb-2">
                  <span class="text-primary me-2"></span>Ligue agora!
                </p>
                <h5 class="mb-0">+001 120 1990</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
            <div class="h-100 bg-light d-flex align-items-center p-5">
              <div class="btn-lg-square bg-white flex-shrink-0">
                <i class="fa fa-envelope-open text-primary"></i>
              </div>
              <div class="ms-4">
                <p class="mb-2">
                  <span class="text-primary me-2"></span>Nos envie um e-mail
                </p>
                <h5 class="mb-0">ingen_jurassicpark@gmail.com</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-5">
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
            <p><span class="text-primary me-2"></span>Fale conosco!</p>
            <h1 class="display-5 mb-4">Tem alguma dúvida? Entre em contato conosco</h1>
            <p class="mb-4">
              The contact form is currently inactive. Get a functional and
              working contact form with Ajax & PHP in a few minutes. Just copy
              and paste the files, add a little code and you're done.
              <a href="https://htmlcodex.com/contact-form">Download Now</a>.
            </p>
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control bg-light border-0"
                      id="name"
                      placeholder="Seu Nome"
                    />
                    <label for="name">Seu Nome</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input
                      type="email"
                      class="form-control bg-light border-0"
                      id="email"
                      placeholder="Seu Email"
                    />
                    <label for="email">Seu Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control bg-light border-0"
                      id="subject"
                      placeholder="Subject"
                    />
                    <label for="subject">Assunto</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea
                      class="form-control bg-light border-0"
                      placeholder="Leave a message here"
                      id="message"
                      style="height: 100px"
                    ></textarea>
                    <label for="message">Mensagem</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn w-100 py-3" style="background-color: #cf1500; border-color: #cf1500; color: #ffffff;" type="submit">
                    Enviar mensagem
                  </button>
                </div>
                </div>
              </div>
            </form>
          </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
              <div class="h-100" style="min-height: 400px">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4043235.75817828!2d-87.58267874002274!3d8.25568388340193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f92e56221acc925%3A0x6254f72535819a2b!2sCosta%20Rica!5e0!3m2!1spt-BR!2sbr!4v1750769257183!5m2!1spt-BR!2sbr"
                    width="800" 
                    height="600" 
                    style="border: 12px;;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                  ></iframe>
                </div>
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
            <h5 class="text-light mb-4">Links rapidos</h5>
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
              class="btn"
              style="background-color: #cf1500; border-color: #cf1500; color: #ffffff; padding: 8px 16px; position: absolute; top: 8px; right: 8px;"
            >
              Sign Up
            </button>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Jurassic Park</a>, Todos os direitos reservados
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

   <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background-color: #cf1500; border-color: #cf1500; color: white;">
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
</php>
