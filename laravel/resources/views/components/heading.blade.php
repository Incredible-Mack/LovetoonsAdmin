@props(['prelink' => '', 'heading' => 'Dashboard', 'links' => ''])

  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0 font-weight-bold"> {{ $heading }} </h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                  @php
                      echo $heading === 'Dashboard'
                          ? "<button class='btn btn-success float-sm-right' >Add Product</button>"
                          : '<ol class="breadcrumb float-sm-right">' .
                            '<li class="breadcrumb-item active font-weight-bold"><a href="' . url($prelink) . '">' . $prelink . '</a></li>' .
                            '<li class="breadcrumb-item">' .
                            $links .
                            '</li>' .
                        '</ol>';

                  @endphp


              </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
  </div>