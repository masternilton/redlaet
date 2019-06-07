<section class="content" >

 <div class="col-md-12">

  <div class="box box-primary  box-gris">
 
    <div class="box-body">

      
        @if (count($errors) > 0)
               
        
                                                         
        <ul class='red-text'>
            @foreach ($errors->all() as $error)
                <li class='red-text'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
            @endforeach
        </ul>
   

        @endif

              
      <form   action="{{ url('crear_usuario') }}"  method="post" id="f_crear_usuario" class="formentrada" >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <div class="row">

            <div class="col-md-6">
                    <div class="form-group  ">
                      <label class="col-sm-2" for="nombre">Nombres*   </label>
                      <div class="col-sm-10" >
                     <span class="help-block" >  </span>
                        <input type="text" class="form-control" id="nombres" name="nombres"  value="{{ old('nombres') }}"  required   >
                       
                    </div>
            </div><!-- /.form-group -->
            </div><!-- /.col -->
                
            <div class="col-md-6">
                      <div class="form-group  ">
    									  <label class="col-sm-2" for="apellido">Apellido*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
    										<input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}"  required >
                        </div>
    									</div><!-- /.form-group -->

            </div><!-- /.col -->
            
            <div class="col-md-6">
              <div class="form-group ">
                <label class="col-sm-2" for="pais">Pais*   </label>
                <div class="col-sm-10" >
               <span class="help-block" >   </span>
               
            
            <select name="pais" id="pais" class="browser-default form-control" required >	
              <option value="0" disabled >Seleccionar</option>	
              <option value="{{ old('pais') }}">{{ old('pais') }}</option>	
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
                 
              </div>
            </div><!-- /.form-group -->
            </div><!-- /.col -->
                
            <div class="col-md-6">
                      <div class="form-group ">
                        <label class="col-sm-2" for="ciudad">Ciudad*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"  required >
                        </div>
                      </div><!-- /.form-group -->

            </div><!-- /.col -->


         
                
            <div class="col-md-6">
                      <div class="form-group  ">
                        <label class="col-sm-2" for="telefono">Telefono*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
                        <input type="number" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}"  >
                        </div>
                      </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="form-group ">
                  <label class="col-sm-2" for="ocupacion">Ocupaciòn</label>
                  <div class="col-sm-10" >
                  <span class="help-block" ></span> 
                  <input type="text" class="form-control" id="ocupacion" name="ocupacion"    >
                  </div>

              </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="form-group ">
                  <label class="col-sm-2" for="institucion">Institucion</label>
                  <div class="col-sm-10" >
                  <span class="help-block" ></span> 
                  <input type="text" class="form-control" id="institucion" name="institucion"   >
                  </div>

              </div><!-- /.form-group -->

            </div><!-- /.col -->


        </div><!-- /.col -->


        <div class="row">

        

        
        <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                    <h5 class="box-title">Datos de acceso</h5>
        </div>
       

                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="col-sm-2" for="email">eMail*</label>
                    <div class="col-sm-10" >
                     <span class="help-block" </span> 
                    <input type="email" class="form-control" id="email" name="email"  value="{{ old('email') }}"  required >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-sm-2" for="email">Password*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" ></span> 
                        <input type="password" class="form-control" id="password" name="password"    required >
                        </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

          
                  
                <div class="col-md-12" style='margin-top:20px;'>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
                   </div>
                
                  </div>

                   


            



                  


                   </form>
                    
    </div>            
  </div>
</div>
</section>


