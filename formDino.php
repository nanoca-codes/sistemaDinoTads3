<?php include("validarSessao.php");?>
<?php include("header.php");?>

    <div class="container-fluid reserve-container d-flex justify-content-center align-items-center">
      <div class="reserve-box p-5 text-center wow fadeInUp" data-wow-delay="0.3s">
        <img
          class="reserve-logo img-fluid mb-4"
          src="img/Jurassic_Park_logo.png"
          alt="Jurassic Park Logo"
        />
        <h2 class="reserve-message mb-2">Cadastre um novo dinossauro!</h2>
        <p class="secondary-message">Adicione uma nova espécie ao nosso parque.</p>

        <?php
          if(isset($_GET['cadastroDino'])){ 
              $statusCadastroDino = $_GET['cadastroDino']; 
              if($statusCadastroDino == 'sucesso'){ 
                  echo "<div class='alert alert-success text-center'>Dinossauro cadastrado com sucesso!</div>";
              }
              if($statusCadastroDino == 'erro'){ 
                  echo "<div class='alert alert-danger text-center'>Erro ao cadastrar o dinossauro. Tente novamente.</div>";
              }
              if($statusCadastroDino == 'erroValidacao'){ 
                  echo "<div class='alert alert-warning text-center'>Por favor, preencha todos os campos corretamente.</div>";
              }
              if($statusCadastroDino == 'erroUpload'){
                  echo "<div class='alert alert-danger text-center'>Erro ao fazer upload da imagem.</div>";
              }
          }
        ?>

        <form action="cadastrarDino.php" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-3 text-start">
            <label for="nomeDinossauro" class="form-label">Nome do Dinossauro</label>
            <input
              type="text"
              class="form-control"
              id="nomeDinossauro"
              name="nomeDinossauro"
              placeholder="Ex: T-Rex"
              required
            />
          </div>
          <div class="form-group mb-3 text-start">
            <label for="especieDinossauro" class="form-label">Espécie</label>
            <input
              type="text"
              class="form-control"
              id="especieDinossauro"
              name="especieDinossauro"
              placeholder="Ex: Tyrannosaurus Rex"
              required
            />
          </div>
          <div class="form-group mb-3 text-start">
            <label for="dietaDinossauro" class="form-label">Dieta</label>
            <select class="form-select" id="dietaDinossauro" name="dietaDinossauro" required>
              <option value="">Selecione a dieta</option>
              <option value="Carnívoro">Carnívoro</option>
              <option value="Herbívoro">Herbívoro</option>
              <option value="Onívoro">Onívoro</option>
            </select>
          </div>
          <div class="form-group mb-3 text-start">
            <label for="generoDinossauro" class="form-label">Gênero</label>
            <select class="form-select" id="generoDinossauro" name="generoDinossauro" required>
              <option value="">Selecione o gênero</option>
              <option value="Macho">Macho</option>
              <option value="Fêmea">Fêmea</option>
            </select>
          </div>
          <div class="form-group mb-4 text-start">
            <label for="fotoDinossauro" class="form-label">Foto do Dinossauro</label>
            <input
              type="file"
              class="form-control"
              id="fotoDinossauro"
              name="fotoDinossauro"
              accept="image/*"
              required
            />
          </div>
          
          <button type="submit" class="btn btn-reserve w-100 mb-3">Cadastrar Dinossauro</button>
        </form>
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
                class="btn"
                style="
                  background-color: #cf1500;
                  border-color: #cf1500;
                  color: #ffffff;
                  padding: 8px 16px;
                  position: absolute;
                  top: 8px;
                  right: 8px;
                "
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
              &copy; <a class="border-bottom" href="#">Jurassic Park</a>, Todos os
              direitos reservados
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
    <a
      href="#"
      class="btn btn-lg btn-lg-square back-to-top"
      style="background-color: #cf1500; border-color: #cf1500; color: white;"
    >
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