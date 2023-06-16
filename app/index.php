<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
    <script src="assets/scripts/angular.min.js"></script>
</head>

<body>
    <section ng-app="myApp" ng-controller="myCtrl" class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Subscribe Now</p>

                                    <form class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="inpFirstName" class="form-control"
                                                    ng-model="FirstName" />
                                                <label class="form-label" for="form3Example1c">First Name</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="inpLastName" class="form-control"
                                                    ng-model="LastName" />
                                                <label class="form-label" for="form3Example1c">Last Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example3c" class="form-control"
                                                    ng-model="Email" />
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                            </div>
                                        </div>


                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="inpAgreeTerms" ng-model="AgreeTerms" />
                                            <label class="form-check-label" for="form2Example3">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button ng-click="Subscribe()" type="button"
                                                class="btn btn-primary">Subscribe</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function ($scope) {

        // Variables
        $scope.FirstName = "";
        $scope.LastName = "";
        $scope.Email = "";
        $scope.AgreeTerms = false;

        // Events
        $scope.Subscribe = function () {
            if (IsFormValid()) {
                Subscribe();
            }
        }


        // Functions
        function Subscribe() {

            // Loading Subscribe Flag
            $scope.loadingSubscribe = true;
            // Request Url
            var url = "../service/operation/user/add.php";


            // Form Object
            var formData = new FormData();
            formData.append("first_name", $scope.FirstName);
            formData.append("last_name", $scope.LastName);
            formData.append("email", $scope.Email);

            $http({
                method: 'POST',
                url: url,
                data: formData
            }).then(function (res) {
                // Setting Loading Subscribe flag to false after reuqest completion.
                $scope.loadingSubscribe = false;

                if (res.data.status == "success") {

                }
                else {
                    console.log(res.data);
                }
            }, function (error) {
                // Setting Loading Subscribe flag to false after reuqest completion.
                $scope.loadingSubscribe = false;

            });
        }

        function IsFormValid() {
            return true;
        }
    });
</script>

</html>