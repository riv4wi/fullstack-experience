/**
 * WorkExperience class
 *
 * @summary     Attributes and methods of ´WorkExperience´ class
 *
 * @since       1.0.1
 * @requires    jQuery, moment
 * @class       WorkExperience
 * @classdesc   Class for modeling the entity ´work experience´
 * @author      riv4wi
 * @created_at  07/07/2018
 */

"use strict";

class WorkExperience {

    /**
     * @summary Constructor of the class.
     *
     * In this constructor is where the attributes of the class are initialized
     *
     * @access public
     *
     * @class WorkExperience
     */
    constructor() {

        /**
         * Attributes of the class
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.attributes = {
            id: '',
            company: '',
            company_activity: '',
            job_title: '',
            country_company: '',
            start_company: '',
            end_company: '',
            duration: '',
            job_description: '',
            level: {
                junior: 'Junior',
                semiSenior: 'Semi-senior',
                Senior: 'Senior',
            }
        };

        /**
         * Json object that contains the attributes to be updated
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.updated_fields = {};

        /**
         * Internal variables where the instances of the dom that are handled are stored
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.instance = {
            /* The attributes for the sending of the creation of work experience are inserted */
            work_experience: '',

            /* Stores the element of the DOM that is the body of work experience */
            container_experience_html: ''
        };

        /**
         * HTML containers associated with the events
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.containers = {};

        /**
         * Listeners associated with the containers
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.listeners = {};

        /**
         * Callbacks for server responses.
         *
         * @since 1.0.1
         * @access public
         * @type {Object}
         */
        this.callbacks = {
            on_init_request: function () {
            },
            on_complete_request: function () {
            },
            on_create_success: function () {
                return false;
            },
            on_update_success: function () {
                return false;
            },
            on_delete_success: function () {
                return false;
            }
        };

    }


    /***************************************
     *                                      *
     *         GETTERS & SETTERS            *
     *                                      *
     ***************************************/

    /**
     * @summary Get ID.
     * @access public
     * @returns {Number} Identifier
     */
    get id() {
        return this.attributes.id;
    }

    /**
     * @summary Set ID.
     * @access public
     * @param {Number} id Identifier.
     */
    set id(id) {
        this.attributes.id = id;
    }

    /**
     * @summary Get company.
     * @access public
     * @returns {String} company
     */
    get company() {
        return this.attributes.company;
    }

    /**
     * @summary Set company.
     * @access public
     * @param {String} company.
     */
    set company(company) {
        this.attributes.company = company;
    }

    /**
     * @summary Get company 's activity.
     * @access public
     * @returns {String} company_activity
     */
    get company_activity() {
        return this.attributes.company_activity;
    }

    /**
     * @summary Set company's activity.
     * @access public
     * @param {String} company_activity.
     */
    set company_activity(company_activity) {
        this.attributes.company_activity = company_activity;
    }

    /**
     * @summary Get the area of the position in the company.
     * @access public
     * @returns {String} job_title
     */
    get job_title() {
        return this.attributes.job_title;
    }

    /**
     * @summary Set the area of the position in the company.
     * @access public
     * @param {String} job_title
     */
    set job_title(job_title) {
        this.attributes.job_title = job_title;
    }

    /**
     * @summary Get country of company.
     * @access public
     * @returns {String} country_company
     */
    get country_company() {
        return this.attributes.country_company;
    }

    /**
     * @summary Set country of company.
     * @access public
     * @param {String} country_company
     */
    set country_company(country_company) {
        this.attributes.country_company = country_company;
    }

    /**
     * @summary Get date of start in the company.
     * @access public
     * @returns {String} start_company
     */
    get start_company() {
        return this.attributes.start_company;
    }

    /**
     * @summary Set date of start in the company.
     * @access public
     * @param {String} start_company
     */
    set start_company(start_company) {
        this.attributes.start_company = start_company;
    }

    /**
     * @summary Get date of end in the company.
     * @access public
     * @returns {String} end_company
     */
    get end_company() {
        return this.attributes.end_company;
    }

    /**
     * @summary Set date of end in the company.
     * @access public
     * @param {String} end_company
     */
    set end_company(end_company) {
        this.attributes.end_company = end_company;
    }

    /**
     * @summary Get duration - This is a field calculated in base to two dates: start_company and end_company.
     * @access public
     * @returns {String} duration
     */
    get duration() {
        return this.attributes.duration;
    }

    /**
     * @summary Set duration.
     * @access public
     * @param {String} duration
     */
    set duration(duration) {
        this.attributes.duration = duration;
    }

    /**
     * @summary Get job's description.
     * @access public
     * @returns {String} job_description
     */
    get job_description() {
        return this.attributes.job_description;
    }

    /**
     * @summary Set job's description.
     * @access public
     * @param {String} job_description
     */
    set job_description(job_description) {
        this.attributes.job_description = job_description;
    }

    /**
     * @summary Get level of the job.
     * @access public
     * @returns {String} level
     */
    get level() {
        return this.attributes.level;
    }

    /**
     * @summary Set level of the job.
     * @access public
     * @param {String} level
     * @returns
     */
    set level(level) {
        this.attributes.level = level;
    }


    /***************************************
     *                                      *
     *          HELPER METHODS              *
     *                                      *
     ***************************************/

    /**
     * @summary Create the work experience from the JSON of the server.
     * @access private
     * @param {Object} work_experience Json with work experience information.
     */
    _fillWorkExperience(work_experience) {
        this.id = work_experience.id;
        this.company = work_experience.company;
        this.company_activity = work_experience.company_activity;
        this.job_title = work_experience.job_title;
        this.country_company = work_experience.country_company;
        this.start_company = work_experience.start_company;
        this.end_company = work_experience.end_company;
        this.duration = work_experience.duration;
        this.job_description = work_experience.job_description;
        this.level = work_experience.level;
    }

    /**
     * @summary Fill the internal attributes of work experience to create.
     * @access public
     * @global {Object} $moment date and time manipulation tool.
     */
    fillWorkExperienceData() {
        this.instance.experience = {
            id: this.id,
            company: this.company,
            company_activity: this.company_activity,
            job_title: this.job_title,
            country_company: this.country_company,
            start_company: this.start_company,
            end_company: this.end_company,
            duration: this.duration,
            job_description: this.job_description,
            level: this.level,
        };

    }


    /***************************************
     *                                      *
     *          SERVER REQUESTS             *
     *                                      *
     ***************************************/

    /**
     * @summary Crea una nueva experiencia laboral.
     *
     * Envio el request para la creacion de la experiencia laboral.
     * Con la respuesta, seteo los campos.
     *
     * @since 1.0.1
     * @access public
     *
     * @global {String} $token The X-CSRF-TOKEN handled by Laravel.
     * @global {Object} $´$´ The jQuery Object.
     * @global {Object} $RedirectUrl.
     *
     * @param
     * @returns
     */
    create() {

        var self = this;

        var route = '/api/experiences';

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data: this.instance.experience,

            beforeSend: function () {
                self.callbacks.on_init_request();
            },
            success: function (response) {
                self._fillWorkExperience(response);
                self.callbacks.on_create_success();
            },
            error: function (response) {
                RedirectUrl.verifyAuthenticate(response);
            },
            complete: function () {
                self.callbacks.on_complete_request();
            }
        });
    }

    /**
     * @summary Actualizo atributos.
     *
     * Envio el request para el update de los campos cambiados
     *
     * @since 1.0.1
     * @access public
     *
     * @global {String} $token The X-CSRF-TOKEN handled by Laravel.
     * @global {Object} $´$´ The jQuery Object.
     * @global {Object} $RedirectUrl.
     *
     * @param
     * @returns
     */
    update() {
        var self = this;

        var route = '/api/experiences/' + self.id;

        var data = {attributes: self.updated_fields};

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            contentType: "application/json; charset=utf-8",
            type: 'PUT',
            data: JSON.stringify(data),
            dataType: 'json',
            beforeSend: function () {
                self.callbacks.on_init_request();
            },
            success: function (response) {
                self._fillWorkExperience(response);
                self.callbacks.on_update_success();
            },
            error: function (response) {
                RedirectUrl.verifyAuthenticate(response);
            },
            complete: function () {
                self.callbacks.on_complete_request();
            }
        });
    }

    /**
     * @summary Actualizo atributos.
     *
     * Envio el request para el delete de la experiencia laboral
     *
     * @since 1.0.1
     * @access public
     *
     * @global {String} $token The X-CSRF-TOKEN handled by Laravel.
     * @global {Object} $´$´ The jQuery Object.
     * @global {Object} $RedirectUrl.
     *
     * @param
     * @returns
     */

    delete() {
        var self = this;

        var route = '/api/experiences/' + self.id;

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            contentType: "application/json; charset=utf-8",
            type: 'DELETE',
            dataType: 'json',
            beforeSend: function () {
                self.callbacks.on_init_request();
            },
            success: function (response) {
                self.callbacks.on_delete_success();
            },
            error: function (response) {
                RedirectUrl.verifyAuthenticate(response);
            },
            complete: function () {
                self.callbacks.on_complete_request();
            }
        });
    }

}