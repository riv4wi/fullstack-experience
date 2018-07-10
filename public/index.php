<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
    <meta content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/material.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/cv.css">
<body>
<section class="formSection pb-50 pt-50">
    <div class="formBackground">
        <div class="container">
            <div class="row">
                <form class="styleForm" id="formulario">
                    <div class="fieldForm">
                        <div class="container">
                            <h1 class="box-experience-title">Experiencia laboral</h1>

                            <!--div where the experience that the user is loading is shown-->
                            <div id="experiences">No hay experiencia laboral cargada aún.</div>

                            <h4>Llena los datos y agrega tu experiencia</h4>

                            <!--div form-experience-->
                            <div id="form-experience">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 marginInputForm">
                                            <input type="text" class="formStyle" id="company" name="company"
                                                   placeholder="Nombre de la empresa" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 marginInputForm">
                                            <input type="text" class="formStyle" id="company_activity"
                                                   name="company_activity"
                                                   placeholder="Industria, actividad o sector de la empresa" required>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 marginInputForm">
                                            <input type="text" class="formStyle" id="job_title"
                                                   name="job_title" placeholder="Puesto"
                                                   aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3 marginInputForm">
                                            <input type="text" class="formStyle" name="level" placeholder="Nivel"
                                                   required>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 marginInputForm">
                                            <input type="text" class="formStyle" id="country_company"
                                                   name="country_company" placeholder="Pais" required>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 marginInputForm">
                                            <label class="control-label" for="registration-date">Desde:</label>
                                            <input class="form-control" name="start_company" id="start_company"
                                                   type="date">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 marginInputForm">
                                            <label class="control-label" for="registration-date">Hasta:</label>
                                            <input class="form-control" name="end_company" id="end_company" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 marginInputForm">
                                            <input type="text" class="formStyle" id="job_description"
                                                   name="job_description" placeholder="Descripcion" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 marginInputForm">
                                            <input type="text" class="formStyle" name="dependents"
                                                   placeholder="Personas a cargo" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 marginInputForm">
                                            <input type="text" class="formStyle" id="reference_contact"
                                                   name="reference_contact" placeholder="Persona de Referencia"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <a class="add-job" onclick="addExperienceWork()">x</a>
                                    </div>
                                </div>
                            </div>

                            <!--template workExperience-->
                            <template id="workExperience">
                                <div class="workExperience pos-relative">
                                    <div class="readonly">
                                        <div class="box-experience">
                                            <div class="row">
                                                <div class="col-xs-10">
                                                    <h2 class="box-experience-subtitle company"></h2>
                                                </div>
                                                <div class="col-xs-2">
                                                    <a class="remove-job">x</a>
                                                    <a class="modify-job">x</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Industria / Sector</b> <span class="company_activity"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <b>Puesto </b><span class="job_title"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <b>País </b><span class="country_company"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Fecha de Inicio </b><span class="start_company"></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <b>Fecha de Finalización </b><span class="end_company"></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <b>Duración de la experiencia </b><span class="duration"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b>Descripción de las tareas</b>
                                                    <span class="job_description"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b>Referencias</b>
                                                    <span class="reference_contact"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="submitButtonForm col-md-2 col-sm-2 col-xs-2 col-md-offset-10 col-sm-2 col-sm-offset-8 col-xs-offset-8">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="enviado"></div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment-with-locales.js"></script>
<script src="js/moment-timezone-with-data.js"></script>
<!--<script src="js/ew.js"></script>-->

<script type="text/javascript">
    function elapsedTime(s_date, e_date) {
        let start_date = moment(s_date, "YYYY-MM-DD").locale('es');
        let end_date = moment(e_date, "YYYY-MM-DD").locale('es');
        let diff = end_date.diff(start_date, 'milliseconds');
        let duration = moment.duration(diff);
        let elapsed = '';

        let years = duration.years();
        let months = duration.months(); // duration.asYears();
        let days = duration.days();

        if (years > 0)
            elapsed = elapsed + years + ' año(s) ';
        if (months > 0)
            elapsed = elapsed + months + ' mes(es) ';
        if (days > 0)
            elapsed = elapsed + days + ' día(s)';

        return elapsed;
    }

    function addExperienceWork() {
        // Test to see if the browser supports the HTML template element by checking
        // for the presence of the template element's content attribute.
        if ('content' in document.createElement('template')) {
            let tpl_workExperience = document.querySelector('#workExperience').content.cloneNode(true);
            let experiences = document.querySelector('#experiences');
            let form = document.querySelector('#formulario');

            if (experiences.innerText === 'No hay experiencia laboral cargada aún.') experiences.innerText = '';

            tpl_workExperience.querySelector('.company').innerText = form.querySelector('#company').value;
            tpl_workExperience.querySelector('.company_activity').innerText = form.querySelector('#company_activity').value;
            tpl_workExperience.querySelector('.job_title').innerText = form.querySelector('#job_title').value;
            tpl_workExperience.querySelector('.country_company').innerText = form.querySelector('#country_company').value;
            tpl_workExperience.querySelector('.start_company').innerText = form.querySelector('#start_company').value;
            tpl_workExperience.querySelector('.end_company').innerText = form.querySelector('#end_company').value;
            let fecha1 = moment(form.querySelector('#start_company').value, "YYYY-MM-DD").locale('es');
            let fecha2 = moment(form.querySelector('#end_company').value, "YYYY-MM-DD").locale('es');
            tpl_workExperience.querySelector('.duration').innerText = elapsedTime(fecha1, fecha2);
            tpl_workExperience.querySelector('.job_description').innerText = form.querySelector('#job_description').value;
            tpl_workExperience.querySelector('.reference_contact').innerText = form.querySelector('#reference_contact').value;
            experiences.appendChild(tpl_workExperience);

            // Cleaning the inputs
            $(":text", $("#form-experience")).val('');
            form.querySelector('#start_company').value = form.querySelector('#end_company').value = 'dd/mm/yyyy';
        }
        else {
            // Find another way to add the rows to the table because
            // the HTML template element is not supported.
        }
    }
</script>
</body>
</html>