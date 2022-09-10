@extends('layouts.app')

@section('content')
  

<div class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
   
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    
    <img class="animation__shake" src="dist/img/yacine.jpg" alt="Loading" height="60" width="60">
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
          <img src="dist/img/yacine.jpg" class="img-circle elevation-2" alt="User Image">
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
            @if (Session::has('product_update'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('product_update')}}
            </div>
            @elseif (Session::has('product_update_fail'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('product_update_fail')}}
            </div>
            @endif
          <div class="col-sm-6">
            
            <h1 class="m-0">Dashboard</h1>
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
          <!-- Navbar -->
         
            <!-- Content Header (Page header) -->
            
              <div class="container-fluid">
                <div class="row mb-2">
                    
             
                </div>
              </div><!-- /.container-fluid -->
            </section>
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
               
            
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Tous Les Produits</h3>
        
                        <div class="card-tools">
                            
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Titre</th>
                              
                              <th>Image</th>
                              <th>Prix D'achat</th>
                              <th>Prix De vente</th>
                              <th>Quantité</th>
                              <th>Ajoué le</th>
                              <th>Action</th>


                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->titre }}</td>
                                <td><img  style="width: 150px;" src="images/{{$product->image_path}}"></td>
                                <td>{{ $product->prix_achat }}</td>
                                <td>{{ $product->prix_vente }}</td>
                                <td>{{ $product->quantite }}</td>
                                <td>{{ $product->created_at}}</td>
                               
                                <td>
                                    <div class="btn-group-vertical">
                                     
                                        <a href="{{url('product.edit'.$product->id)}} "type="button"  class="btn btn-success mb-1" data-toggle="modal" data-target="#editmodal">
                                            Afficher
                                        </a>

                                        <a href="product/{{ $product->id }}/edit" type="button"  class="btn btn-primary mb-3" >
                                            Modifier
                                        </a>

                                       

                                           <form action="{{ route('product.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                                <button type="submit" class="btn btn-danger mt-3" >
                                                    Supprimer
                                                </button>
                                           </form>
                                      </div>
                                    
                                </td>
                                    <div >

                                    </div>
                                </td>
                              </tr>
                            @endforeach
                           
                           
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <!-- /.row -->
           
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







