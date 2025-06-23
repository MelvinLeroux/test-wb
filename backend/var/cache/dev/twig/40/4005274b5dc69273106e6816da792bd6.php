<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* module/show.html.twig */
class __TwigTemplate_ca9ed184e31766913156d59228bc68a0 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "module/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "module/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Module Details";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        return; yield '';
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <h1>";
        yield Twig\Extension\EscaperExtension::escape($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 6, $this->source); })()), "name", [], "any", false, false, false, 6), "html", null, true);
        yield "</h1>
    ";
        // line 7
        $context["currentTime"] = Twig\Extension\CoreExtension::dateFormatFilter($this->env, "now", "U");
        // line 8
        yield "    ";
        if ((((CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 8, $this->source); })()), "status", [], "any", false, false, false, 8) == 1) && CoreExtension::getAttribute($this->env, $this->source, ($context["module"] ?? null), "startedAt", [], "any", true, true, false, 8)) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 8, $this->source); })()), "startedAt", [], "any", false, false, false, 8)))) {
            // line 9
            yield "        <p class=\"alert alert-success\">Etat du module: En marche </p>
        ";
            // line 10
            $context["startTime"] = Twig\Extension\CoreExtension::dateFormatFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 10, $this->source); })()), "startedAt", [], "any", false, false, false, 10), "U");
            // line 11
            yield "        ";
            $context["durationSeconds"] = ((isset($context["currentTime"]) || array_key_exists("currentTime", $context) ? $context["currentTime"] : (function () { throw new RuntimeError('Variable "currentTime" does not exist.', 11, $this->source); })()) - (isset($context["startTime"]) || array_key_exists("startTime", $context) ? $context["startTime"] : (function () { throw new RuntimeError('Variable "startTime" does not exist.', 11, $this->source); })()));
            // line 12
            yield "        ";
            $context["durationHours"] = (int) floor(((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 12, $this->source); })()) / 3600));
            // line 13
            yield "        ";
            $context["durationMinutes"] = (int) floor((((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 13, $this->source); })()) % 3600) / 60));
            // line 14
            yield "        ";
            $context["durationSecondsLeft"] = ((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 14, $this->source); })()) % 60);
            // line 15
            yield "        <p class=\"alert alert-secondary\">
            Durée de fonctionnement : ";
            // line 16
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationHours"]) || array_key_exists("durationHours", $context) ? $context["durationHours"] : (function () { throw new RuntimeError('Variable "durationHours" does not exist.', 16, $this->source); })()), "html", null, true);
            yield " heures, ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationMinutes"]) || array_key_exists("durationMinutes", $context) ? $context["durationMinutes"] : (function () { throw new RuntimeError('Variable "durationMinutes" does not exist.', 16, $this->source); })()), "html", null, true);
            yield " minutes et ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationSecondsLeft"]) || array_key_exists("durationSecondsLeft", $context) ? $context["durationSecondsLeft"] : (function () { throw new RuntimeError('Variable "durationSecondsLeft" does not exist.', 16, $this->source); })()), "html", null, true);
            yield " secondes
        </p>
    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 18
($context["module"] ?? null), "stoppedAt", [], "any", true, true, false, 18) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 18, $this->source); })()), "stoppedAt", [], "any", false, false, false, 18)))) {
            // line 19
            yield "        <p class= \"alert alert-danger\">Etat du module: Eteint</p>
        ";
            // line 20
            $context["stoppedTime"] = Twig\Extension\CoreExtension::dateFormatFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 20, $this->source); })()), "stoppedAt", [], "any", false, false, false, 20), "U");
            // line 21
            yield "        ";
            $context["durationSeconds"] = ((isset($context["currentTime"]) || array_key_exists("currentTime", $context) ? $context["currentTime"] : (function () { throw new RuntimeError('Variable "currentTime" does not exist.', 21, $this->source); })()) - (isset($context["stoppedTime"]) || array_key_exists("stoppedTime", $context) ? $context["stoppedTime"] : (function () { throw new RuntimeError('Variable "stoppedTime" does not exist.', 21, $this->source); })()));
            // line 22
            yield "        ";
            $context["durationHours"] = (int) floor(((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 22, $this->source); })()) / 3600));
            // line 23
            yield "        ";
            $context["durationMinutes"] = (int) floor((((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 23, $this->source); })()) % 3600) / 60));
            // line 24
            yield "        ";
            $context["durationSecondsLeft"] = ((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 24, $this->source); })()) % 60);
            // line 25
            yield "        <div class=\"alert alert-secondary\">
            <p>
                Mise en pause depuis ";
            // line 27
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationHours"]) || array_key_exists("durationHours", $context) ? $context["durationHours"] : (function () { throw new RuntimeError('Variable "durationHours" does not exist.', 27, $this->source); })()), "html", null, true);
            yield " heures, ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationMinutes"]) || array_key_exists("durationMinutes", $context) ? $context["durationMinutes"] : (function () { throw new RuntimeError('Variable "durationMinutes" does not exist.', 27, $this->source); })()), "html", null, true);
            yield " minutes et ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["durationSecondsLeft"]) || array_key_exists("durationSecondsLeft", $context) ? $context["durationSecondsLeft"] : (function () { throw new RuntimeError('Variable "durationSecondsLeft" does not exist.', 27, $this->source); })()), "html", null, true);
            yield " secondes
            </p>
            <span>
                ";
            // line 30
            $context["startTime"] = Twig\Extension\CoreExtension::dateFormatFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 30, $this->source); })()), "startedAt", [], "any", false, false, false, 30), "U");
            // line 31
            yield "                ";
            $context["stoppedTime"] = Twig\Extension\CoreExtension::dateFormatFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 31, $this->source); })()), "stoppedAt", [], "any", false, false, false, 31), "U");
            // line 32
            yield "                ";
            $context["workingTime"] = ((isset($context["stoppedTime"]) || array_key_exists("stoppedTime", $context) ? $context["stoppedTime"] : (function () { throw new RuntimeError('Variable "stoppedTime" does not exist.', 32, $this->source); })()) - (isset($context["startTime"]) || array_key_exists("startTime", $context) ? $context["startTime"] : (function () { throw new RuntimeError('Variable "startTime" does not exist.', 32, $this->source); })()));
            // line 33
            yield "                ";
            $context["workingHours"] = (int) floor(((isset($context["workingTime"]) || array_key_exists("workingTime", $context) ? $context["workingTime"] : (function () { throw new RuntimeError('Variable "workingTime" does not exist.', 33, $this->source); })()) / 3600));
            // line 34
            yield "                ";
            $context["workingMinutes"] = (int) floor((((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 34, $this->source); })()) % 3600) / 60));
            // line 35
            yield "                ";
            $context["workingSecondsLeft"] = ((isset($context["durationSeconds"]) || array_key_exists("durationSeconds", $context) ? $context["durationSeconds"] : (function () { throw new RuntimeError('Variable "durationSeconds" does not exist.', 35, $this->source); })()) % 60);
            // line 36
            yield "                Le module a fonctionné pendant :  ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["workingHours"]) || array_key_exists("workingHours", $context) ? $context["workingHours"] : (function () { throw new RuntimeError('Variable "workingHours" does not exist.', 36, $this->source); })()), "html", null, true);
            yield " heures, ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["workingMinutes"]) || array_key_exists("workingMinutes", $context) ? $context["workingMinutes"] : (function () { throw new RuntimeError('Variable "workingMinutes" does not exist.', 36, $this->source); })()), "html", null, true);
            yield " minutes et ";
            yield Twig\Extension\EscaperExtension::escape($this->env, (isset($context["workingSecondsLeft"]) || array_key_exists("workingSecondsLeft", $context) ? $context["workingSecondsLeft"] : (function () { throw new RuntimeError('Variable "workingSecondsLeft" does not exist.', 36, $this->source); })()), "html", null, true);
            yield " secondes
            </span>
        </div>
    ";
        } else {
            // line 40
            yield "        <p>Etat du module: Inconnu</p>
    ";
        }
        // line 42
        yield "
    ";
        // line 43
        $context["sensorData"] = [];
        // line 44
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["sensors"]) || array_key_exists("sensors", $context) ? $context["sensors"] : (function () { throw new RuntimeError('Variable "sensors" does not exist.', 44, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["sensor"]) {
            // line 45
            yield "        ";
            $context["sensorItem"] = ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["sensor"], "id", [], "any", false, false, false, 45), "type" => CoreExtension::getAttribute($this->env, $this->source, $context["sensor"], "type", [], "any", false, false, false, 45)];
            // line 46
            yield "        ";
            $context["sensorData"] = Twig\Extension\CoreExtension::arrayMerge((isset($context["sensorData"]) || array_key_exists("sensorData", $context) ? $context["sensorData"] : (function () { throw new RuntimeError('Variable "sensorData" does not exist.', 46, $this->source); })()), [(isset($context["sensorItem"]) || array_key_exists("sensorItem", $context) ? $context["sensorItem"] : (function () { throw new RuntimeError('Variable "sensorItem" does not exist.', 46, $this->source); })())]);
            // line 47
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sensor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        yield " 

    ";
        // line 49
        $context["measurementData"] = [];
        // line 50
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["measurements"]) || array_key_exists("measurements", $context) ? $context["measurements"] : (function () { throw new RuntimeError('Variable "measurements" does not exist.', 50, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["measurement"]) {
            // line 51
            yield "        ";
            $context["sensorId"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["measurement"], "sensor", [], "any", false, false, false, 51), "id", [], "any", false, false, false, 51);
            // line 52
            yield "        ";
            $context["measurementItem"] = ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["measurement"], "id", [], "any", false, false, false, 52), "value" => CoreExtension::getAttribute($this->env, $this->source, $context["measurement"], "value", [], "any", false, false, false, 52), "createdAt" => CoreExtension::getAttribute($this->env, $this->source, $context["measurement"], "createdAt", [], "any", false, false, false, 52), "sensorId" => (isset($context["sensorId"]) || array_key_exists("sensorId", $context) ? $context["sensorId"] : (function () { throw new RuntimeError('Variable "sensorId" does not exist.', 52, $this->source); })())];
            // line 53
            yield "        ";
            $context["measurementData"] = Twig\Extension\CoreExtension::arrayMerge((isset($context["measurementData"]) || array_key_exists("measurementData", $context) ? $context["measurementData"] : (function () { throw new RuntimeError('Variable "measurementData" does not exist.', 53, $this->source); })()), [(isset($context["measurementItem"]) || array_key_exists("measurementItem", $context) ? $context["measurementItem"] : (function () { throw new RuntimeError('Variable "measurementItem" does not exist.', 53, $this->source); })())]);
            // line 54
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['measurement'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "
    ";
        // line 56
        $context["moduleData"] = ["id" => CoreExtension::getAttribute($this->env, $this->source,         // line 57
(isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 57, $this->source); })()), "id", [], "any", false, false, false, 57), "name" => CoreExtension::getAttribute($this->env, $this->source,         // line 58
(isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 58, $this->source); })()), "name", [], "any", false, false, false, 58), "status" => CoreExtension::getAttribute($this->env, $this->source,         // line 59
(isset($context["module"]) || array_key_exists("module", $context) ? $context["module"] : (function () { throw new RuntimeError('Variable "module" does not exist.', 59, $this->source); })()), "status", [], "any", false, false, false, 59), "sensors" =>         // line 60
(isset($context["sensorData"]) || array_key_exists("sensorData", $context) ? $context["sensorData"] : (function () { throw new RuntimeError('Variable "sensorData" does not exist.', 60, $this->source); })()), "measurements" =>         // line 61
(isset($context["measurementData"]) || array_key_exists("measurementData", $context) ? $context["measurementData"] : (function () { throw new RuntimeError('Variable "measurementData" does not exist.', 61, $this->source); })())];
        // line 64
        yield "    
    <div id=\"module-data\" hidden=\"hidden\" data-module=\"";
        // line 65
        yield Twig\Extension\EscaperExtension::escape($this->env, json_encode((isset($context["moduleData"]) || array_key_exists("moduleData", $context) ? $context["moduleData"] : (function () { throw new RuntimeError('Variable "moduleData" does not exist.', 65, $this->source); })())), "html", null, true);
        yield "\"></div>
    <div class=\"block\">
        <p class=\"text-white\">Choisissez un capteur pour afficher les données</p>
        <select id=\"sensor-select\">
            <option value=\"default\">Sélectionner</option>
            ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["moduleData"]) || array_key_exists("moduleData", $context) ? $context["moduleData"] : (function () { throw new RuntimeError('Variable "moduleData" does not exist.', 70, $this->source); })()), "sensors", [], "any", false, false, false, 70));
        foreach ($context['_seq'] as $context["_key"] => $context["sensor"]) {
            // line 71
            yield "                <option value=\"";
            yield Twig\Extension\EscaperExtension::escape($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["sensor"], "id", [], "any", false, false, false, 71), "html", null, true);
            yield "\">";
            yield Twig\Extension\EscaperExtension::escape($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["sensor"], "type", [], "any", false, false, false, 71), "html", null, true);
            yield "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sensor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        yield "        </select>
        <canvas id=\"myChart\"></canvas>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        return; yield '';
    }

    // line 78
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 79
        yield "        <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js\"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let ctx = document.getElementById('myChart').getContext('2d');
            let data = {
                labels: [],
                datasets: [{
                    label: 'Module Data',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };

            let myChart = new Chart(ctx, {
                type: 'line', // Changez ce type selon votre besoin
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: `Module Data`
                        },
                    },
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Value'
                            },
                            suggestedMin: -20,
                            suggestedMax: 50
                        }
                    }
                }
            });

            const moduleData = document.getElementById('module-data');
            const moduleDataParsed = JSON.parse(moduleData.dataset.module);
            const sensorSelect = document.getElementById('sensor-select');

            sensorSelect.addEventListener('change', function() {
                const selectedOption = sensorSelect.selectedOptions[0];
                const selectedTitle = selectedOption.textContent;

                if (sensorSelect.value === 'default') {
                    myChart.data.labels = [];
                    myChart.data.datasets[0].data = [];
                    myChart.update();

                    return;
                }

                const selectedSensorId = parseInt(sensorSelect.value);

                // Get the measurements for the selected sensor
                const measurementsForSelectedSensor = moduleDataParsed.measurements.filter(item => item.sensorId === selectedSensorId);
                // get the last 20 measurements
                const limitedMeasurementsForSelectedSensor = measurementsForSelectedSensor.slice(-20);

                // Format the data for the chart
                const labels = limitedMeasurementsForSelectedSensor.map(item => {
                    const date = new Date(item.createdAt.date);
                    date.setHours(date.getHours() + 2); // +2 because of timezone difference with the server
                    const dayOfMonth = date.getDate();
                    const month = date.getMonth() + 1; // +1 because January is 0
                    const hours = ('0' + date.getHours()).slice(-2);  // slice(-2) to get the last 2 characters
                    const minutes = ('0' + date.getMinutes()).slice(-2); // slice(-2) to get the last 2 characters

                    return `\${dayOfMonth}/\${month} - \${hours}:\${minutes}`;
                });

                const values = limitedMeasurementsForSelectedSensor.map(item => item.value);
                // Update the chart data with the new data
                myChart.data.labels = labels;
                myChart.data.datasets[0].data = values;
                myChart.options.scales.y.suggestedMin = Math.min(...values) - 5;
                myChart.options.scales.y.suggestedMax = Math.max(...values) + 5;
                myChart.options.scales.y.title.text = `\${selectedTitle}`;

                // Update the chart title
                myChart.options.plugins.title.text = `\${moduleDataParsed.name} : \${moduleDataParsed.sensors.find(sensor => sensor.id === selectedSensorId).type} data`;

                myChart.update();
            });
        });
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "module/show.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  282 => 79,  275 => 78,  264 => 73,  253 => 71,  249 => 70,  241 => 65,  238 => 64,  236 => 61,  235 => 60,  234 => 59,  233 => 58,  232 => 57,  231 => 56,  228 => 55,  222 => 54,  219 => 53,  216 => 52,  213 => 51,  208 => 50,  206 => 49,  197 => 47,  194 => 46,  191 => 45,  186 => 44,  184 => 43,  181 => 42,  177 => 40,  165 => 36,  162 => 35,  159 => 34,  156 => 33,  153 => 32,  150 => 31,  148 => 30,  138 => 27,  134 => 25,  131 => 24,  128 => 23,  125 => 22,  122 => 21,  120 => 20,  117 => 19,  115 => 18,  106 => 16,  103 => 15,  100 => 14,  97 => 13,  94 => 12,  91 => 11,  89 => 10,  86 => 9,  83 => 8,  81 => 7,  76 => 6,  69 => 5,  55 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Module Details{% endblock %}

{% block body %}
    <h1>{{ module.name }}</h1>
    {% set currentTime = \"now\"|date('U') %}
    {% if module.status == 1 and module.startedAt is defined and module.startedAt is not null %}
        <p class=\"alert alert-success\">Etat du module: En marche </p>
        {% set startTime = module.startedAt|date('U') %}
        {% set durationSeconds = currentTime - startTime %}
        {% set durationHours = durationSeconds // 3600 %}
        {% set durationMinutes = (durationSeconds % 3600) // 60 %}
        {% set durationSecondsLeft = durationSeconds % 60 %}
        <p class=\"alert alert-secondary\">
            Durée de fonctionnement : {{ durationHours }} heures, {{ durationMinutes }} minutes et {{ durationSecondsLeft }} secondes
        </p>
    {% elseif module.stoppedAt is defined and module.stoppedAt is not null %}
        <p class= \"alert alert-danger\">Etat du module: Eteint</p>
        {% set stoppedTime = module.stoppedAt|date('U') %}
        {% set durationSeconds = currentTime - stoppedTime %}
        {% set durationHours = durationSeconds // 3600 %}
        {% set durationMinutes = (durationSeconds % 3600) // 60 %}
        {% set durationSecondsLeft = durationSeconds % 60 %}
        <div class=\"alert alert-secondary\">
            <p>
                Mise en pause depuis {{ durationHours }} heures, {{ durationMinutes }} minutes et {{ durationSecondsLeft }} secondes
            </p>
            <span>
                {% set startTime = module.startedAt|date('U') %}
                {% set stoppedTime = module.stoppedAt|date('U') %}
                {% set workingTime = stoppedTime - startTime %}
                {% set workingHours = workingTime // 3600 %}
                {% set workingMinutes = (durationSeconds % 3600) // 60 %}
                {% set workingSecondsLeft = durationSeconds % 60 %}
                Le module a fonctionné pendant :  {{ workingHours }} heures, {{ workingMinutes }} minutes et {{ workingSecondsLeft }} secondes
            </span>
        </div>
    {% else %}
        <p>Etat du module: Inconnu</p>
    {% endif %}

    {% set sensorData = [] %}
    {% for sensor in sensors %}
        {% set sensorItem = { 'id': sensor.id, 'type': sensor.type } %}
        {% set sensorData = sensorData|merge([sensorItem]) %}
    {% endfor %} 

    {% set measurementData = [] %}
    {% for measurement in measurements %}
        {% set sensorId = measurement.sensor.id %}
        {% set measurementItem = { 'id': measurement.id, 'value': measurement.value, 'createdAt': measurement.createdAt, 'sensorId': sensorId } %}
        {% set measurementData = measurementData|merge([measurementItem]) %}
    {% endfor %}

    {% set moduleData = {
        id: module.id,
        name: module.name,
        status:module.status,
        'sensors': sensorData,
        'measurements': measurementData 
        }
    %}
    
    <div id=\"module-data\" hidden=\"hidden\" data-module=\"{{ moduleData|json_encode}}\"></div>
    <div class=\"block\">
        <p class=\"text-white\">Choisissez un capteur pour afficher les données</p>
        <select id=\"sensor-select\">
            <option value=\"default\">Sélectionner</option>
            {% for sensor in moduleData.sensors %}
                <option value=\"{{ sensor.id }}\">{{ sensor.type }}</option>
            {% endfor %}
        </select>
        <canvas id=\"myChart\"></canvas>
    </div>
{% endblock %}

{% block javascripts %}
    {# load Chart.js library #}
    <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js\"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let ctx = document.getElementById('myChart').getContext('2d');
            let data = {
                labels: [],
                datasets: [{
                    label: 'Module Data',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };

            let myChart = new Chart(ctx, {
                type: 'line', // Changez ce type selon votre besoin
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: `Module Data`
                        },
                    },
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Value'
                            },
                            suggestedMin: -20,
                            suggestedMax: 50
                        }
                    }
                }
            });

            const moduleData = document.getElementById('module-data');
            const moduleDataParsed = JSON.parse(moduleData.dataset.module);
            const sensorSelect = document.getElementById('sensor-select');

            sensorSelect.addEventListener('change', function() {
                const selectedOption = sensorSelect.selectedOptions[0];
                const selectedTitle = selectedOption.textContent;

                if (sensorSelect.value === 'default') {
                    myChart.data.labels = [];
                    myChart.data.datasets[0].data = [];
                    myChart.update();

                    return;
                }

                const selectedSensorId = parseInt(sensorSelect.value);

                // Get the measurements for the selected sensor
                const measurementsForSelectedSensor = moduleDataParsed.measurements.filter(item => item.sensorId === selectedSensorId);
                // get the last 20 measurements
                const limitedMeasurementsForSelectedSensor = measurementsForSelectedSensor.slice(-20);

                // Format the data for the chart
                const labels = limitedMeasurementsForSelectedSensor.map(item => {
                    const date = new Date(item.createdAt.date);
                    date.setHours(date.getHours() + 2); // +2 because of timezone difference with the server
                    const dayOfMonth = date.getDate();
                    const month = date.getMonth() + 1; // +1 because January is 0
                    const hours = ('0' + date.getHours()).slice(-2);  // slice(-2) to get the last 2 characters
                    const minutes = ('0' + date.getMinutes()).slice(-2); // slice(-2) to get the last 2 characters

                    return `\${dayOfMonth}/\${month} - \${hours}:\${minutes}`;
                });

                const values = limitedMeasurementsForSelectedSensor.map(item => item.value);
                // Update the chart data with the new data
                myChart.data.labels = labels;
                myChart.data.datasets[0].data = values;
                myChart.options.scales.y.suggestedMin = Math.min(...values) - 5;
                myChart.options.scales.y.suggestedMax = Math.max(...values) + 5;
                myChart.options.scales.y.title.text = `\${selectedTitle}`;

                // Update the chart title
                myChart.options.plugins.title.text = `\${moduleDataParsed.name} : \${moduleDataParsed.sensors.find(sensor => sensor.id === selectedSensorId).type} data`;

                myChart.update();
            });
        });
    </script>
{% endblock %}", "module/show.html.twig", "/Users/melvinleroux/Dev/test-wb/templates/module/show.html.twig");
    }
}
