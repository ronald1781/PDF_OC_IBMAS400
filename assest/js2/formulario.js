

$(function() {
    $('#forlogin').validate({
        errorElement: "span",
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 9
            },
            password: {
                required: true,
                minlength: 3
            },
        }
    });
    $('#foraddcar').validate({
        errorElement: "span",
        rules: {
            txtNomcargo: {
                required: true,
                minlength: 3,
                maxlength: 25
            }
        }
    });
    $('#forupdcar').validate({
        errorElement: "span",
        rules: {
            txtNomcargo: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestcorgo: {
                required: true,
            }
        }
    });


    $('#foraddcn').validate({
        errorElement: "span",
        rules: {
            txtNomcn: {
                required: true,
                minlength: 3,
                maxlength: 35
            }
        }
    });
    $('#foredicn').validate({
        errorElement: "span",
        rules: {
            codcn: {
                required: true,
            }
        }
    });
    $('#forupdcn').validate({
        errorElement: "span",
        rules: {
            txtNomcn: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestcn: {
                required: true,
            }
        }
    });

    $('#foraddarea').validate({
        errorElement: "span",
        rules: {
            txtNomarea: {
                required: true,
                minlength: 3,
                maxlength: 35
            }
        }
    });
    $('#forediarea').validate({
        errorElement: "span",
        rules: {
            txtCodarea: {
                required: true,
            }
        }
    });
    $('#forupdarea').validate({
        errorElement: "span",
        rules: {
            txtNomarea: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestarea: {
                required: true,
            }
        }
    });

    $('#foraddmarca').validate({
        errorElement: "span",
        rules: {
            txtNommarca: {
                required: true,
                minlength: 3,
                maxlength: 35
            }
        }
    });
    $('#foredimarca').validate({
        errorElement: "span",
        rules: {
            txtCodmar: {
                required: true,
            }
        }
    });
    $('#forupdmarca').validate({
        errorElement: "span",
        rules: {
            txtNommar: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestmar: {
                required: true,
            }
        }
    });

    $('#foraddarti').validate({
        errorElement: "span",
        rules: {
            txtNomarti: {
                required: true,
                minlength: 3,
                maxlength: 35
            }
        }
    });
    $('#forediarti').validate({
        errorElement: "span",
        rules: {
            txtCodarti: {
                required: true,
            }
        }
    });
    $('#forupdarti').validate({
        errorElement: "span",
        rules: {
            txtNomarti: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestarti: {
                required: true,
            }

        }
    });

    $('#foraddequi').validate({
        errorElement: "span",
        rules: {
            txtNomequi: {
                required: true,
                minlength: 3,
                maxlength: 35
            }
        }
    });
    $('#forediequi').validate({
        errorElement: "span",
        rules: {
            txtCodequi: {
                required: true,
            }
        }
    });
    $('#forupdequi').validate({
        errorElement: "span",
        rules: {
            txtNomequi: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selestequi: {
                required: true,
            }
        }
    });
    /*validacion tipo de equipo*/
    $('#foraddtequi').validate({
        errorElement: "span",
        rules: {
            txtNomtequi: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            selestequi: {
                required: true,
                minlength: 1
            }

        }

    });
    $('#foreditequi').validate({
        errorElement: "span",
        rules: {
            txtCodtequi: {
                required: true,
            }
        }
    });
    $('#forupdtequi').validate({
        errorElement: "span",
        rules: {
            txtNomtequi: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selesttequi: {
                required: true,
            }
        }
    });

    /*validacion tipo de Servicio*/
    $('#foraddtserv').validate({
        errorElement: "span",
        rules: {
            txtNomtserv: {
                required: true,
                minlength: 3,
                maxlength: 35
            }

        }

    });
    $('#foreditserv').validate({
        errorElement: "span",
        rules: {
            txtCodtserv: {
                required: true,
            }
        }
    });
    $('#forupdtserv').validate({
        errorElement: "span",
        rules: {
            txtNomtserv: {
                required: true,
                minlength: 3,
                maxlength: 45
            }
        }
    });

    /*validacion de Servicio*/
    $('#foraddserv').validate({
        errorElement: "span",
        rules: {
            selesttserv: {
                required: true,
                minlength: 1
            },
            txtNomserv: {
                required: true,
                minlength: 3,
                maxlength: 35
            }

        }

    });
    $('#forediserv').validate({
        errorElement: "span",
        rules: {
            txtCodserv: {
                required: true,
            }
        }
    });
    $('#forupdserv').validate({
        errorElement: "span",
        rules: {
            txtNomserv: {
                required: true,
                minlength: 3,
                maxlength: 45
            },
            selesttserv: {
                required: true,
            }
        }
    });

    /*validacion de Software*/
    $('#foraddsoft').validate({
        errorElement: "span",
        rules: {
            txtNomsoft: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtVersof: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtCtlicsof: {
                required: true,
                digits: true,
                //number: true,
                min: 1,
                max: 5
            }

        }

    });
    $('#forediserv').validate({
        errorElement: "span",
        rules: {
            txtCodserv: {
                required: true,
            }
        }
    });
    $('#forupdserv').validate({
        errorElement: "span",
        rules: {
            txtNomsoft: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtVersof: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtCtlicsof: {
                required: true,
                digits: true,
                //number: true,
                min: 1,
                max: 5
            }
        }
    });

    /* Categoria */


    $('#foraddcat').validate({
        errorElement: "span",
        rules: {
            txtNomcate: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtDscat: {
                required: true,
                minlength: 06,
                maxlength: 45
            }

        }

    });
    $('#foredicate').validate({
        errorElement: "span",
        rules: {
            txtCodcate: {
                required: true,
            }
        }
    });
    $('#forupdcate').validate({
        errorElement: "span",
        rules: {
            txtNomcate: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtDesccate: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            selestcate: {
                required: true,
            },
        }
    });



    $('#frmprodu').validate({
        errorElement: "span",
        rules: {
            txtnompro: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            txtdespro: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            selecate: {
                required: true,
            },
             selemar: {
                required: true,
            },
        }
    });

});