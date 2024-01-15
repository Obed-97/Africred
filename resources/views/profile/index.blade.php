@section('title', 'Profile')

@extends('master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
        <div class="row">
            <div class="col-md-3">
            <form enctype="multipart/form-data" method="POST" action="{{route('profile.update', auth()->user()->id)}}">
               @csrf
            {{method_field('PUT')}}
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="avatar-upload mb-3">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url(/assets/images/users/{{Auth::user()->image}}">
                            </div>
                        </div>
                    </div>
  
                  <h3 class="profile-username text-center admin_name mb-2">{{Auth::user()->nom}}</h3>
  
                  <p class="text-muted text-center">{{Auth::user()->email}}</p>
                  <h5 class="profile-username text-center admin_name mb-2">Poste : {{Auth::user()->Role['libelle']}}</h5>

                  
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
          
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="card">
                <div class="card p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Informations personnelles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Changer mot de passe</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="personal_info">
                     
                     
                          
                          <div class="row">
                              <div class="col-xl-8">
                                 <div class="form-group">
                                    <label>Nom complet <b class="text-danger">*</b></label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->nom }}" name="nom" required/>
                                </div>
                              </div>
                              <div class="col-xl-4">
                                <div class="form-group ">
                                    <label>Sexe <b class="text-danger">*</b></label>
                                    <select class="form-control " name="sexe" required>
                                        <option value="{{ Auth::user()->sexe }}" selected>{{ Auth::user()->sexe }} </option>
                                        <option value="Masculin">Masculin </option>
                                        <option value="Féminin">Féminin </option>
                                        
                                    </select>
                                </div>
                            </div>
                            
                          </div>
                          
                          <div class="row">
                              <div class="col-xl-8">
                                   <div class="form-group">
                                        <label>Adresse e-mail <b class="text-danger">*</b></label>
                                        <div>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" required/>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-xl-4">
                                  <div class="form-group">
                                    <label>Téléphone <b class="text-danger">*</b></label>
                                    <div>
                                       <input type="text" class="form-control" value="{{ Auth::user()->telephone }}" name="telephone" required/>
                                    </div>
                                </div>
                              </div>
                            
                          </div>
                            
                            <div class="row">
                              <div class="col-xl-4">
                                   <div class="form-group">
                                        <label>Date de naissance</label>
                                        <div>
                                            <input type="date" class="form-control" value="{{ Auth::user()->date_n }}" name="date_n" />
                                        </div>
                                    </div>
                              </div>
                              <div class="col-xl-4">
                                  <div class="form-group">
                                    <label>Lieu naissance</label>
                                    <div>
                                       <input type="text" class="form-control" value="{{ Auth::user()->lieu_n }}" name="lieu_n" />
                                    </div>
                                </div>
                              </div>
                              <div class="col-xl-4">
                                <div class="form-group ">
                                    <label>Ville </label>
                                    <select class="form-control select2" name="ville" >
                                        <option value="Bamako" selected>Bamako </option>
                                        <option value="Sikasso">Sikasso </option>
                                        <option value="Mopti">Mopti </option>
                                        <option value="Koutiala">Koutiala </option>
                                        <option value="Kayes">Kayes </option>
                                        <option value="Ségou">Ségou </option>
                                        <option value="Kati">Kati </option>
                                        <option value="Gao">Gao </option>
                                        <option value="Kolokani">Kolokani </option>
                                        <option value="Bougouni">Bougouni </option>
                                        <option value="San">San </option>
                                       
                                       
                                    </select>
                                </div>
                            </div>
                          </div>
                            <div class="form-group">
                                <label>Adresse </label>
                                <input type="text" class="form-control" value="{{ Auth::user()->adresse }}" name="adresse" />
                            </div>
                           
                            
                            
                            <div class="form-group mt-2">
                                <div>
                                    <button type="submit" class="btn btn-block btn-danger waves-effect waves-light mr-1">
                                         Mettre à jour
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                
                    <div class="tab-pane" id="change_password">
                         <form method="POST" action="{{route('profile.password')}}">
                               @csrf
                            <div class="form-group">
                                <label>Ancien mot de passe</label>
                                <input type="password" name="old_password" class="form-control" required/>
                            </div>


                            <div class="form-group">
                                <label>Nouveau mot de passe</label>
                                <div>
                                    <input type="password" name="new_password" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group">
                             
                            <div class="form-group">
                                <label>Confirmer mot de passe</label>
                                <div>
                                   <input type="password" name="confirm_password" class="form-control" required/>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-block btn-danger waves-effect waves-light mr-1">
                                        Mettre à jour
                                    </button>
                                    
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        <div class="col-md-3">
  
              <!-- Profile Image -->
              <div >
                <div class="mb-4 mr-4">
                    <div class="col-md-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="heading text-white">AFRICRED-CARD</p>
                            <svg viewBox="0 0 48 48" height="36" width="36" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" class="logos">
                            <path d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z" fill="#ff9800"></path><path d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z" fill="#d50000"></path><path d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z" fill="#ff3d00"></path>
                            </svg>
                            <svg xml:space="preserve" viewBox="0 0 50 50" height="30px" width="30px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" class="chip" version="1.1">  <image href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOY
                              fEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSW
                              ekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GS
                              e0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOW
                              ekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bf
                              u3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWua
                              fUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1
                              lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrb
                              tnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOh
                              g0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU
                              /f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dE
                              orDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2Ng
                              GAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVg
                              OkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3d
                              I2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6a
                              lKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkI
                              JVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0F
                              qBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM
                              1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGm
                              BSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCET
                              amiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdC
                              S24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpj
                              cmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIw
                              MjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAy
                              LTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg==" y="0" x="0" height="50" width="50" id="image0"></image>
                            </svg>
                            <svg xml:space="preserve" viewBox="0 0 50 50" height="25px" width="25px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" class="contactless" version="1.1">  <image href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAQAAAC0NkA6AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                              cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IEzgIwaKTAAADDklEQVRYw+1XS0iUURQ+f5qPyjQf
                              lGRFEEFK76koKGxRbWyVVLSOgsCgwjZBJJYuKogSIoOonUK4q3U0WVBWFPZYiIE6kuArG3VGzK/F
                              fPeMM/MLt99/NuHdfPd888/57jn3nvsQWWj/VcMlvMMd5KRTogqx9iCdIjUUmcGR9ImUYowyP3xN
                              GQJoRLVaZ2DaZf8kyjEJALhI28ELioyiwC+Rc3QZwRYyO/DH51hQgWm6DMIh10KmD4u9O16K49it
                              VoPOAmcGAWWOepXIRScAoJZ2Frro8oN+EyTT6lWkkg6msZfMSR35QTJmjU0g15tIGSJ08ZZMJkJk
                              HpNZgSkyXosS13TkJpZ62mPIJvOSzC1bp8vRhhCakEk7G9/o4gmZdbpsTcKu0m63FbnBP9Qrc15z
                              bkbemfgNDtEOI8NO5L5O9VYyRYgmJayZ9nPaxZrSjW4+F6Uw9yQqIiIZwhp2huQTf6OIvCZyGM6g
                              DJBZbyXifJXr7FZjGXsdxADxI7HUJFB6iWvsIhFpkoiIiGTJfjJfiCuJg2ZEspq9EHGVpYgzKqwJ
                              qSAOEwuJQ/pxPvE3cYltJCLdxBLiSKKIE5HxJKcTRNeadxfhDiuYw44zVs1dxKwRk/uCxIiQkxKB
                              sSctRVAge9g1E15EHE6yRUaJecRxcWlukdRIbGFOSZCMWQA/iWauIP3slREHXPyliqBcrrD71Amz
                              Z+rD1Mt2Yr8TZc/UR4/YtFnbijnHi3UrN9vKQ9rPaJf867ZiaqDB+czeKYmd3pNa6fuI75MiC0uX
                              XSR5aEMf7s7a6r/PudVXkjFb/SsrCRfROk0Fx6+H1i9kkTGn/E1vEmt1m089fh+RKdQ5O+xNJPUi
                              cUIjO0Dm7HwvErEr0YxeibL1StSh37STafE4I7zcBdRq1DiOkdmlTJVnkQTBTS7X1FYyvfO4piaI
                              nKbDCDaT2anLudYXCRFsQBgAcIF2/Okwgvz5+Z4tsw118dzruvIvjhTB+HOuWy8UvovEH6beitBK
                              xDyxm9MmISKCWrzB7bSlaqGlsf0FC0gMjzTg6GgAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjMtMDIt
                              MTNUMDg6MTk6NTYrMDA6MDCjlq7LAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIzLTAyLTEzVDA4OjE5
                              OjU2KzAwOjAw0ssWdwAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyMy0wMi0xM1QwODoxOTo1Nisw
                              MDowMIXeN6gAAAAASUVORK5CYII=" y="0" x="0" height="50" width="50" id="image0"></image>
                            </svg>
                            <p class="number text-white">ABF-00{{auth()->user()->id}}-{{(new DateTime(auth()->user()->created_at))->format('y')}}    </p>
                            
                            <p class="date text-white">1 2 / 2 4</p>
                            <p class="name text-white"><b style = "text-transform:uppercase;">{{auth()->user()->nom}}</b></p>
                        </div>
                        <div class="flip-card-back">
                            <div class="strip"></div>
                            <div class="mstrip"></div>
                            <div class="sstrip">
                              <p class="code">***</p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
          
            </div>
          <!-- /.row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
<!-- end main content-->
@endsection