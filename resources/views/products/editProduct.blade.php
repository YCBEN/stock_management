@extends('layouts.app')

@section('content')
  

<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
   
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    
    <img class="animation__shake" src="{{ asset('dist/img/yacine.jpg') }}" alt="Loading" height="60" width="60">
  </div>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmodal">
           Ajouter
          </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/yacine.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>ChartJS</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>ChartJS</p>
            </a>
          </li>
      </ul>

      <!-- Sidebar Menu -->
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produit: {{$product->titre}}</h1>
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="hold-transition sidebar-mini">
        <div class="wrapper">         
            </section>
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
               
                <div class="row">
                    <div class="d-flex justify-content-center align-items-center">
                     
                      <div class="card card-widget">
                        <div class="card-header">
                          <div class="user-block">
                            <form action="{{ route('product.update',$product->id)}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <span class="username">{{ $product->user->name}}</span>
                            <span class="description">Ajouté le {{$product->created_at}}</span>

                          </div>
                          <!-- /.user-block -->
                          <div class="card-tools">
                            <a href="{{ route('home') }}" type="button" class="btn btn-danger" >
                                Annuler
                              </button></a>
                            <button type="submit" class="btn btn-success" >
                              sauvegarder
                            </button>
                          
                          </div>
                          <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           
                            <div>
                                <label for="image_path" class="form-label">Modifier l'image</label>
                                <input name="image_path" type="file"   class="form-control form-control-lg" id="image_path"  >
                            </div>
                          <img class="img-fluid pad" src="{{ asset('images/'.$product->image_path) }}" alt="Photo"/>
          
                          <hr>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Titre:</label>
                                <input type="text"  name="titre"  class="form-control" id="titre" value="{{$product->titre}}"/>
                           
                            </div>

                            <div class="mb-3">
                                <label for="prix_achat" class="form-label">Prix Achat</label>
                                <input type="number" value="{{ $product->prix_achat}}" name="prix_achat" class="form-control" id="prix_achat" min="0">
                               
                              </div>
                            
                              <div class="mb-3">
                                <label for="prix_vente" class="form-label">Prix Vente</label>
                                <input type="number" value="{{ $product->prix_vente}}" name="prix_vente" class="form-control" id="prix_vente" min="0">
                               
                              </div>
                              <div class="mb-3">
                                <label for="quantite" class="form-label">Quantité</label>
                                <input type="number" value="{{ $product->quantite}}" name="quantite" class="form-control" id="quantite" min="0">
                               
                              </div>
                            
                              
                            </form>
                        <!-- /.card-footer -->
                      
                        </div>
                        <!-- /.card-footer -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                
           
              </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          
       
      

    </div>

</div>
<!-- ./wrapper -->


</div>








<!-- Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addmodalTitle">Ajouter un produit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/product" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="titre" class="form-label">Titre Produit</label>
                <input type="text" name="titre" class="form-control" id="titre">
               
              </div>
  
              <div class="mb-3">
                  <label for="prix_achat" class="form-label">Prix Achat</label>
                  <input type="number" name="prix_achat" class="form-control" id="prix_achat" min="0">
                 
                </div>
  
                <div class="mb-3">
                  <label for="prix_vente" class="form-label">Prix Vente</label>
                  <input type="number" name="prix_vente" class="form-control" id="prix_vente" min="0">
                 
                </div>
                <div class="mb-3">
                  <label for="quantite" class="form-label">Quantité</label>
                  <input type="number" name="quantite" class="form-control" id="quantite" min="0">
                 
                </div>
  
  
                <div>
                  <label for="image_path" class="form-label">Ajouter une image</label>
                  <input class="form-control form-control-lg" id="image_path" type="file" name="image_path">
                </div>
                
          
          
              
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
        </div>
      </div>
    </div>
  </div>
  