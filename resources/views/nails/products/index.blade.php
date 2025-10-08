@extends('index')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="mb-2 page-title">Products</h2>
          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Company</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>368</td>
                        <td>Imani Lara</td>
                        <td>(478) 446-9234</td>
                        <td>Asset Management</td>
                        <td>Borland</td>
                        <td>9022 Suspendisse Rd.</td>
                        <td>High Wycombe</td>
                        <td>Jun 8, 2019</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>323</td>
                        <td>Walter Sawyer</td>
                        <td>(671) 969-1704</td>
                        <td>Tech Support</td>
                        <td>Macromedia</td>
                        <td>Ap #708-5152 Cursus. Ave</td>
                        <td>Bath</td>
                        <td>May 8, 2020</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>371</td>
                        <td>Noelle Ray</td>
                        <td>(803) 792-2559</td>
                        <td>Human Resources</td>
                        <td>Sibelius</td>
                        <td>Ap #992-8933 Sagittis Street</td>
                        <td>Ivanteyevka</td>
                        <td>Apr 2, 2021</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>302</td>
                        <td>Portia Nolan</td>
                        <td>(216) 946-1119</td>
                        <td>Payroll</td>
                        <td>Microsoft</td>
                        <td>Ap #461-4415 Enim Rd.</td>
                        <td>Kanpur Cantonment</td>
                        <td>Dec 4, 2019</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>443</td>
                        <td>Scarlett Anderson</td>
                        <td>(486) 309-3564</td>
                        <td>Tech Support</td>
                        <td>Yahoo</td>
                        <td>P.O. Box 988, 7282 Lobortis Avenue</td>
                        <td>Lot</td>
                        <td>Dec 27, 2019</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>345</td>
                        <td>Kevyn Mills</td>
                        <td>(976) 873-4833</td>
                        <td>Tech Support</td>
                        <td>Sibelius</td>
                        <td>P.O. Box 666, 9803 Sed Avenue</td>
                        <td>Fino Mornasco</td>
                        <td>Dec 24, 2020</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>                    
                    </tbody>
                  </table>

                  <table class="table datatables" id="dataTable-2" dis>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
          </div> 
        </div> 
      </div> 
    </div>
</main> 

<script>
    $(document).ready(function () {
        $('#dataTable-1').DataTable(
            {
                autoWidth: true,
                "lengthMenu": [
                  [16, 32, 64, -1],
                  [16, 32, 64, "All"]
                ]
            }
        );

        
        $('#dataTable-2').DataTable( {
          autoWidth: true,
          lengthMenu: [
            [1, 32, 64, -1],
            [1, 32, 64, "All"]
          ],
          ajax: {
              url: '/nails/get-data',
              dataSrc : 'data'
          },
          columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'price' },
          ],
        } );
    });
</script>
@endsection