 @extends('layouts.auth')
 @section('htmlheader_title')
Registro
@endsection
  
@section('content')

<body>      



<div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Relaet Cargando</p>
        </div>
    </div>


        <!-- Main navigation -->
   

          <!-- Full Page Intro -->
          <div class="view" style="background-image: url({{ asset('/assets/img/bg_003.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center center; ">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-blue-slight d-flex justify-content-center align-items-center" style='position: relative; overflow:auto;'>
   
              <!-- Content -->
              <div class="container" style='margin-top: 0px;'>
                <!--Grid row-->
                <div class="row mt-5">
                  <!--Grid column-->
                  <div class="col-md-5 mb-4 mt-md-0 mt-4 white-text text-center text-md-left">
                    <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s"><img src="{{ asset('/assets/img/logoh.png') }}" width="210"></h1>
                    <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                    <h4 class="mb-3 wow fadeInLeft"><i class="fa fa-user-plus white-text"></i> Registro de Usuario</h4>
                    <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">

La Red Latinoamericana de Etnomatemática tiene como propósitos:
<br/>
Promover e impulsar el estudio y la investigación del pensamiento matemático de personas iletradas, pueblos indigenas, pueblos afro descendientes y grupos laborales.
<br/>
Rescatar las investigaciones aisladas realizadas en Latinoamérica y proponer nuevos trabajos de investigación en las universidades a nivel de pregrado, maestría y doctorado.
<br/>
Crear una red de personas respetuosas y consientes de la diversidad cultural de América Latina, e interesadas en la investigación en el campo de la Etnomatemática.</h6>
                    <a class="btn btn-outline-white wow fadeInLeft" target='_blank' href='#' data-wow-delay="0.3s">Ver Términos y Condiciones</a>
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-md-7 col-xl-7 mb-5"  >
                    <!--Form-->
                    <form id="form_register" method="post" action="{{ url('/registro_usuario') }}">
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                  
                   <div class="align-items-center" data-wow-delay="0.3s" style="background-color: rgba(3, 14, 19, 0.89); ">
                      <div class="card-body">
                        <!--Header-->
                        
                        <!--Body-->

                        <div class="md-form col-xs-12">
                          <i class="fa fa-envelope prefix white-text active"> </i>
                          <input type="email" class="white-text form-control valCP_email" required id="email_usuario" name="email_usuario">
                          <label for="email" class="active">Email</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-lock prefix white-text active"></i>
                                  <input type="password" id="password_usuario" class="white-text form-control" required name="password_usuario">
                                  <label for="password_usuario">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-lock prefix white-text active"></i>
                                  <input type="password" id="password_usuario_2" class="white-text form-control" required name="password_usuario_2">
                                  <label for="password_usuario_2">Confirmar Contraseña</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-user prefix white-text active"></i>
                                  <input type="text" id="nombre_usuario" class="white-text form-control" required name="nombre_usuario">
                                  <label for="nombre_usuario" class="active">Nombres</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-user prefix white-text active"></i>
                                  <input type="text" id="apellido_usuario" class="white-text form-control" required name="apellido_usuario">
                                  <label for="apellido_usuario" class="active">Apellidos</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-address-card prefix white-text active"></i>
                                  <input type="text" id="profesion_usuario" class="white-text form-control" required name="profesion_usuario">
                                  <label for="profesion_usuario" class="active">Profesión</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-university prefix white-text active"></i>
                                  <input type="text" id="institucion_usuario" class="white-text form-control " name="institucion_usuario">
                                  <label for="institucion_usuario" class="active">Institucion</label>
                                </div>
                            </div>
                        </div>

                   

                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form" >
                                  <i class="fa fa-map-marker prefix white-text active"></i>
                                  
                                  <select name="pais_usuario" id="pais_usuario" class="browser-default form-control"  style='border-bottom:1px solid white;border-top:none;border-left:none;border-right:none; color:white; margin-left:20px;' required >	
              <option value="0" disabled >Seleccionar</option>	
         	
              <option value="Afganistán">Afganistán</option>	
              <option value="Albania">Albania</option>	
              <option value="Alemania">Alemania</option>	
              <option value="Andorra">Andorra</option>	
              <option value="Angola">Angola</option>	
              <option value="Antigua y Barbuda">Antigua y Barbuda</option>	
              <option value="Arabia Saudita">Arabia Saudita</option>	
              <option value="Argelia">Argelia</option>	
              <option value="Argentina">Argentina</option>	
              <option value="Armenia">Armenia</option>	
              <option value="Australia">Australia</option>	
              <option value="Austria">Austria</option>	
              <option value="Azerbaiyán">Azerbaiyán</option>	
              <option value="Bahamas">Bahamas</option>	
              <option value="Bahrein">Bahrein</option>	
              <option value="Bangladesh">Bangladesh</option>	
              <option value="Barbados">Barbados</option>	
              <option value="Bélgica">Bélgica</option>	
              <option value="Bélice">Bélice</option>	
              <option value="Benin">Benin</option>	
              <option value="Bielorrusia">Bielorrusia</option>	
              <option value="Bolivia">Bolivia</option>	
              <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>	
              <option value="Botsuana">Botsuana</option>	
              <option value="Brasil">Brasil</option>	
              <option value="Brunei">Brunei</option>	
              <option value="Bulgaria">Bulgaria</option>	
              <option value="Burkina Faso">Burkina Faso</option>	
              <option value="Burundi">Burundi</option>	
              <option value="Bután">Bután</option>	
              <option value="Cabo Verde">Cabo Verde</option>	
              <option value="Camboya">Camboya</option>	
              <option value="Camerún">Camerún</option>	
              <option value="Canadá">Canadá</option>	
              <option value="Chad">Chad</option>	
              <option value="Chile">Chile</option>	
              <option value="China">China</option>	
              <option value="Chipre">Chipre</option>	
              <option value="Colombia">Colombia</option>	
              <option value="Comoras">Comoras</option>	
              <option value="Corea del Norte">Corea del Norte</option>	
              <option value="Corea del Sur">Corea del Sur</option>	
              <option value="Costa de Marfil">Costa de Marfil</option>	
              <option value="Costa Rica">Costa Rica</option>	
              <option value="Croacia">Croacia</option>	
              <option value="Cuba">Cuba</option>	
              <option value="Dinamarca">Dinamarca</option>	
              <option value="Dominica">Dominica</option>	
              <option value="Ecuador">Ecuador</option>	
              <option value="Egipto">Egipto</option>	
              <option value="El Salvador">El Salvador</option>	
              <option value="Emiratos Arabes Unidos">Emiratos Arabes Unidos</option>	
              <option value="Eritrea">Eritrea</option>	
              <option value="Eslovaquia">Eslovaquia</option>	
              <option value="Eslovenia">Eslovenia</option>	
              <option value="España">España</option>	
              <option value="Estados Unidos">Estados Unidos</option>	
              <option value="Estonia">Estonia</option>	
              <option value="Etiopía">Etiopía</option>	
              <option value="Filipinas">Filipinas</option>	
              <option value="Finlandia">Finlandia</option>	
              <option value="Fiyi">Fiyi</option>	
              <option value="Francia">Francia</option>	
              <option value="Gabón">Gabón</option>	
              <option value="Gambia">Gambia</option>	
              <option value="Georgia">Georgia</option>	
              <option value="Ghana">Ghana</option>	
              <option value="Granada">Granada</option>	
              <option value="Grecia">Grecia</option>	
              <option value="Guatemala">Guatemala</option>	
              <option value="Guinea">Guinea</option>	
              <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>	
              <option value="Guinea Francesa">Guinea Francesa</option>	
              <option value="Guinea-Bissau">Guinea-Bissau</option>	
              <option value="Guyana">Guyana</option>	
              <option value="Haití">Haití</option>	
              <option value="Honduras">Honduras</option>	
              <option value="Hungría">Hungría</option>	
              <option value="India">India</option>	
              <option value="Indonesia">Indonesia</option>	
              <option value="Irán">Irán</option>	
              <option value="Iraq">Iraq</option>	
              <option value="Irlanda">Irlanda</option>	
              <option value="Islandia">Islandia</option>	
              <option value="Islas Georgias del Sur y Sandwich del Sur">Islas Georgias del Sur y Sandwich del Sur</option>	
              <option value="Islas Malvinas">Islas Malvinas</option>	
              <option value="Islas Marshall">Islas Marshall</option>	
              <option value="Islas Salomón">Islas Salomón</option>	
              <option value="Israel">Israel</option>	
              <option value="Italia">Italia</option>	
              <option value="Jamaica">Jamaica</option>	
              <option value="Japón">Japón</option>	
              <option value="Jordania">Jordania</option>	
              <option value="Kazajistán">Kazajistán</option>	
              <option value="Kenia">Kenia</option>	
              <option value="Kirguistán">Kirguistán</option>	
              <option value="Kiribati">Kiribati</option>	
              <option value="Kuwait">Kuwait</option>	
              <option value="Laos">Laos</option>	
              <option value="Leshoto">Leshoto</option>	
              <option value="Letonia">Letonia</option>	
              <option value="Líbano">Líbano</option>	
              <option value="Libia">Libia</option>	
              <option value="Liechtenstein">Liechtenstein</option>	
              <option value="Lituania">Lituania</option>	
              <option value="Luxemburgo">Luxemburgo</option>	
              <option value="Madagascar">Madagascar</option>	
              <option value="Malasia">Malasia</option>	
              <option value="Malaui">Malaui</option>	
              <option value="Maldivas">Maldivas</option>	
              <option value="Mali">Mali</option>	
              <option value="Malta">Malta</option>	
              <option value="Marruecos">Marruecos</option>	
              <option value="Mauricio">Mauricio</option>	
              <option value="Mauritania">Mauritania</option>	
              <option value="México">México</option>	
              <option value="Micronesia">Micronesia</option>	
              <option value="Moldavia">Moldavia</option>	
              <option value="Mónaco">Mónaco</option>	
              <option value="Mongolia">Mongolia</option>	
              <option value="Montenegro">Montenegro</option>	
              <option value="Mozambique">Mozambique</option>	
              <option value="Myanmar (birmania)">Myanmar (birmania)</option>	
              <option value="Namibia">Namibia</option>	
              <option value="Nauru">Nauru</option>	
              <option value="Nepal">Nepal</option>	
              <option value="Nicaragua">Nicaragua</option>	
              <option value="Níger">Níger</option>	
              <option value="Nigeria">Nigeria</option>	
              <option value="Noruega">Noruega</option>	
              <option value="Nueva Zelanda">Nueva Zelanda</option>	
              <option value="Omán">Omán</option>	
              <option value="Países Bajos">Países Bajos</option>	
              <option value="Pakistán">Pakistán</option>	
              <option value="Palaos">Palaos</option>	
              <option value="Panamá">Panamá</option>	
              <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>	
              <option value="Paraguay">Paraguay</option>	
              <option value="Perú">Perú</option>	
              <option value="Polonia">Polonia</option>	
              <option value="Portugal">Portugal</option>	
              <option value="Puerto Rico">Puerto Rico</option>	
              <option value="Qatar">Qatar</option>	
              <option value="Reino Unido">Reino Unido</option>	
              <option value="República Centroafricana">República Centroafricana</option>	
              <option value="República Checa">República Checa</option>	
              <option value="República de Macedonia">República de Macedonia</option>	
              <option value="República del Congo">República del Congo</option>	
              <option value="República DemocrAtica del Congo">República DemocrAtica del Congo</option>	
              <option value="República Dominicana">República Dominicana</option>	
              <option value="república saharaui">república saharaui</option>	
              <option value="Ruanda">Ruanda</option>	
              <option value="Rumania">Rumania</option>	
              <option value="Rusia">Rusia</option>	
              <option value="Samoa">Samoa</option>	
              <option value="San Cristóbal y Nevis">San Cristóbal y Nevis</option>	
              <option value="San Marino">San Marino</option>	
              <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>	
              <option value="Santa Lucía">Santa Lucía</option>	
              <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>	
              <option value="Senegal">Senegal</option>	
              <option value="Serbia">Serbia</option>	
              <option value="Seychelles">Seychelles</option>	
              <option value="Sierra Leona">Sierra Leona</option>	
              <option value="Singapur">Singapur</option>	
              <option value="Siria">Siria</option>	
              <option value="Somalia">Somalia</option>	
              <option value="Sri Lanka">Sri Lanka</option>	
              <option value="Suazilandia">Suazilandia</option>	
              <option value="SudAfrica">SudAfrica</option>	
              <option value="SudAn del norte">SudAn del norte</option>	
              <option value="Sudan del sur">Sudan del sur</option>	
              <option value="Suecia">Suecia</option>	
              <option value="Suiza">Suiza</option>	
              <option value="Surinam">Surinam</option>	
              <option value="Tailandia">Tailandia</option>	
              <option value="Tanzania">Tanzania</option>	
              <option value="Tayikistán">Tayikistán</option>	
              <option value="Timor Oriental">Timor Oriental</option>	
              <option value="Togo">Togo</option>	
              <option value="Tonga">Tonga</option>	
              <option value="Trinidad y Tobago">Trinidad y Tobago</option>	
              <option value="Túnez">Túnez</option>	
              <option value="Turkmenistán">Turkmenistán</option>	
              <option value="Turquía">Turquía</option>	
              <option value="Tuvalu">Tuvalu</option>	
              <option value="Ucrania">Ucrania</option>	
              <option value="uganda">uganda</option>	
              <option value="Uruguay">Uruguay</option>	
              <option value="Uzbekistán">Uzbekistán</option>	
              <option value="Vanuatu">Vanuatu</option>	
              <option value="Vaticano">Vaticano</option>	
              <option value="Venezuela">Venezuela</option>	
              <option value="Vietnam">Vietnam</option>	
              <option value="Yemen">Yemen</option>	
              <option value="Yibuti">Yibuti</option>	
              <option value="Zambia">Zambia</option>	
              <option value="Zimbabue">Zimbabue</option>	
              <option value=""></option>	
              </select>
                 
                                  <label for="pais_usuario" class="active">Pais</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                  <i class="fa fa-map-pin prefix white-text active"></i>
                                  <input type="text" id="ciudad_usuario" class="white-text form-control" required name="ciudad_usuario">
                                  <label for="ciudad_usuario" class="active">Ciudad</label>
                                </div>
                            </div>
                        </div>
                       
                       <div class="g-recaptcha" data-sitekey="6Lf8E48UAAAAAPKhfVjtRgZRy6n4PuOUn9Gkt4KM" style="margin:0 auto;"></div>
                        

                        <div class="row">
                            <div class="col-md-6">
                              <div class="text-center mt-4">
                                    <button class="btn red accent-4  m-l-5 waves-effect waves-light" type="submit">Crea tu Cuenta Relaet</button>
                              </div>
                            </div>
                            <div class="col-md-6">
                                  <div class="text-left mt-4">

                                 <div class="form-check mr-3">


                                    <input type="checkbox" id="aceptar_tc" name="aceptar_tc" class="filled-in form-check-input classcod" value="true" >

                                    <label class="form-check-label text-white" for="aceptar_tc">Aceptar Terminos Y Condiciones</label>
                                  </div>
                                </div>
                               
                            </div>
                        </div>

                        <hr class="hr-light mb-3 mt-4">
                                    <div class="inline-ul text-center d-flex justify-content-center">
                                      <div class="col-sm-12 text-center">
                                          <h6 style="color: #ffffff">Ya tienes una cuenta? <a href="{{ url('/login') }}" class="text-info m-l-5"><b>Ingresa Aquí</b></a></h6>
                                      </div>
                                    </div>

                         

                        

                      </div>
                    </div>
                    </form>
                    <!--/.Form-->
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
          <!-- Full Page Intro -->
 
 </body>
@endsection


