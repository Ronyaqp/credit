<?php
defined('BASEPATH') or exit('Acción no permitida');
require FCPATH . 'vendor/autoload.php';
require_once('./dompdf/autoload.inc.php');
require_once APPPATH . 'third_party/fpdf/fpdf.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//use Dompdf\Dompdf;

class Reporte extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }
        $this->load->model('prestamos_model');
    }

    public function index()
    {
        $data = array(
            'titulo' => 'Consulta de Créditos',
            'subtitulo' => 'Consulta por Fechas, Cliente y Asesor',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                // 'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'prestamos' => $this->prestamos_model->get_all(),
            'clientes' => $this->core_model->get_all('tb_clientes'),
            'asesores' => $this->core_model->get_all('tb_asesores')
        );
        $this->load->view('layout/header', $data);
        $this->load->view('reportes/index');
        $this->load->view('layout/footer');
    }

    public function creditoscliente()
    {
        $data = array(
            'titulo' => 'Consultar Prestamos por Cliente',
            'subtitulo' => 'Seleccionar el Cliente',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'prestamos' => $this->prestamos_model->get_all(),
            'clientes' => $this->core_model->get_all('tb_clientes')
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/prestamoscliente');
        $this->load->view('layout/footer');
    }

    public function creditosasesor()
    {
        $data = array(
            'titulo' => 'Consultar Créditos por Asesor',
            'subtitulo' => 'Seleccionar el Asesor',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'asesores' => $this->core_model->get_all('tb_asesores')
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/creditosasesor');
        $this->load->view('layout/footer');
    }

    public function estadocuentacliente()
    {
        $data = array(
            'titulo' => 'Estado de Cuenta por Cliente',
            'subtitulo' => 'Seleccionar Cliente',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'clientes' => $this->core_model->get_all("tb_clientes")
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/estadocuentacliente');
        $this->load->view('layout/footer');
    }

    public function pagosclientesfechas()
    {
        $data = array(
            'titulo' => 'Pagos por Cliente y Fechas',
            'subtitulo' => 'Seleccionar Cliente',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'clientes' => $this->core_model->get_all("tb_clientes")
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/pagosclientesfechas');
        $this->load->view('layout/footer');
    }

    public function estadocuentafechas()
    {
        $data = array(
            'titulo' => 'Estado de Cuenta por Fecha de Cuota',
            'subtitulo' => 'Seleccionar Cliente e Ingresa la Fecha de Cuota',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'clientes' => $this->core_model->get_all("tb_clientes")
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/estadocuentafechas');
        $this->load->view('layout/footer');
    }

    public function plandepago()
    {
        $data = array(
            'titulo' => 'Generar Plan de Pago',
            'subtitulo' => 'Seleccionar el Crédito',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'clientes' => $this->core_model->get_all("tb_clientes")
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/plandepago');
        $this->load->view('layout/footer');
    }

    public function creditosasesorfechasestado()
    {
        $data = array(
            'titulo' => 'Consultar Créditos por Asesor, Fechas y Estado',
            'subtitulo' => 'Seleccionar los campos requeridos',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'asesores' => $this->core_model->get_all('tb_asesores')
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/creditos_asesor_fechas_estado');
        $this->load->view('layout/footer');
    }

    public function pagosestado()
    {
        $data = array(
            'titulo' => 'Consultar de Cuotas por Fechas y Estado',
            'subtitulo' => 'Seleccionar los campos requeridos',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            )
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/pagosestadofechas');
        $this->load->view('layout/footer');
    }

    public function pago_asesor()
    {
        $data = array(
            'titulo' => 'Consultar Pagos por Asesor y Fechas',
            'subtitulo' => 'Seleccionar los campos requeridos',
            'icono' => 'fas fa-comments-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'plugins/select2/dist/css/select2.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/select2/dist/js/select2.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/activaDatatable.js',
                'js/reportes/utils.js'
            ),
            'asesores' => $this->core_model->get_all('tb_asesores')
        );

        $this->load->view('layout/header', $data);
        $this->load->view('reportes/pagos_asesor');
        $this->load->view('layout/footer');
    }

    public function getPlanPago()
    {
        $idcliente = $this->input->post("idcliente");
        if ($idcliente == "") {
            $creditos = $this->prestamos_model->get_all();
        } else {
            $creditos = $this->prestamos_model->getCreditoByCliente($idcliente);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $forma_pago = '';
            if ($credito->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($credito->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($credito->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($credito->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';

            if ($credito->estado == 0) {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check-circle"></i> PAGADO</span>';
            }
            if ($credito->estado == 1) {
                $estado = '<span class="badge badge-primary mb-1"><i class="fas fa-sync-alt"></i> POR COBRAR</span>';
            }
            if ($credito->estado == 2) {
                $estado = '<span class="badge badge-danger mb-1"><i class="fas fa-lock"></i> EN PROCESO</span>';
            }
            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombres,
                'fechaCredito' => formatoFechaCorta($credito->fecha_credito),
                'montoCredito' => $credito->monto_credito,
                'interes' => $credito->interes_credito,
                'cuotas' => $credito->numero_coutas,
                'totalInteres' => $credito->total_interes,
                'totalPagar' => $credito->total_pagar,
                'formaPago' => $forma_pago,
                'button' => "<a target='_blank' href='" . base_url() . 'reporte/planpagoid/' . $credito->id . "' class='btn btn-danger'><i class='fas fa-file-pdf'></i></a>"
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function planpagoid($id)
    {
        if (!$id || !$this->core_model->get_by_id('tb_creditos', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Registro no encontrado');
            redirect($this->router->fetch_class());
        }
        $this->load->library('pdf');
        //$coutas = $this->prestamos_model->get_all_by_id($id);
        $prestamo = $this->prestamos_model->get_by_id($id);

        $file_name = 'PLAN DE PAGO N° ' . $prestamo->id;
        $data = array(
            'file_name' => $file_name,
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamo' => $prestamo,
            'cuotas' => $this->prestamos_model->get_all_by_id($id),
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/pdf_plan_pago_cliente', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'portrait');
    }

    public function getCreditosCliente()
    {
        $cliente_id = $this->input->post('clienteid');
        $creditos = $this->prestamos_model->getCreditoByCliente($cliente_id);
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $forma_pago = '';
            if ($credito->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($credito->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($credito->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($credito->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';

            if ($credito->estado == 0) {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check-circle"></i> PAGADO</span>';
            }
            if ($credito->estado == 1) {
                $estado = '<span class="badge badge-primary mb-1"><i class="fas fa-sync-alt"></i> POR COBRAR</span>';
            }
            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'idCredito' => $credito->id,
                'fechaCredito' => $credito->fecha_credito,
                'montoCredito' => $credito->monto_credito,
                'interes' => $credito->interes_credito,
                'coutas' => $credito->numero_coutas,
                'totalInteres' => $credito->total_interes,
                'totalPagar' => $credito->total_pagar,
                'formaPago' => $forma_pago,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function pagosasesor()
    {
        $idasesor = $this->input->post('idasesor');
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFin = $this->input->post('fechaFin');

        if ($idasesor == "0") {
            $creditos = $this->prestamos_model->getPagosAllAsesor($fechaInicio, $fechaFin);
        } else {
            $creditos = $this->prestamos_model->getPagosAsesor($idasesor, $fechaInicio, $fechaFin);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;

            $estado = '';
            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'fecha_pago' => $credito->fecha_pago,
                'monto_pago' => number_format($credito->monto_pago, 2),
                'descuento_pago' => $credito->descuento_pago
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);

    }

    public function getCreditosAsesor()
    {
        $idasesor = $this->input->post('idasesor');
        if ($idasesor == "0") {
            $creditos = $this->prestamos_model->getCreditosByAll();
        } else {
            $creditos = $this->prestamos_model->getCreditoByAsesor($idasesor);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $forma_pago = '';
            if ($credito->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($credito->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($credito->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($credito->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';

            if ($credito->estado == 0) {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check-circle"></i> CANCELADO</span>';
            }
            if ($credito->estado == 1) {
                $estado = '<span class="badge badge-primary mb-1"><i class="fas fa-sync-alt"></i> PENDIENTE</span>';
            }
            if ($credito->estado == 2) {
                $estado = '<span class="badge badge-danger mb-1"><i class="fas fa-lock"></i> EN PROCESO</span>';
            }
            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'idCredito' => $credito->id,
                'fechaCredito' => $credito->fecha_credito,
                'montoCredito' => $credito->monto_credito,
                'interes' => $credito->interes_credito,
                'coutas' => $credito->numero_coutas,
                'totalInteres' => $credito->total_interes,
                'totalPagar' => $credito->total_pagar,
                'formaPago' => $forma_pago,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function getCreditoFechas()
    {
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFin = $this->input->post('fechaFin');
        $idcliente = $this->input->post('idcliente');
        $idasesor = $this->input->post('idasesor');
        if ($idasesor == 0) {
            $creditos = $this->prestamos_model->getByDatesNoAsesor($fechaInicio, $fechaFin, $idcliente);
        } else {
            $creditos = $this->prestamos_model->getByDates($fechaInicio, $fechaFin, $idcliente, $idasesor);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $forma_pago = '';
            if ($credito->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($credito->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($credito->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($credito->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';

            if ($credito->estado == 0) {
                $estado = '<span class="badge  badge-success mr-2 mb-1"><i class="fas fa-check-circle"></i> PAGADO</span>';
            }
            if ($credito->estado == 1) {
                $estado = '<span class="badge badge-primary mr-2 mb-1"><i class="fas fa-sync-alt"></i> POR COBRAR</span>';
            }
            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'idCredito' => $credito->id,
                'fechaCredito' => formatoFechaCorta($credito->fecha_credito),
                'montoCredito' => number_format($credito->monto_credito, 2),
                'interes' => $credito->interes_credito,
                'coutas' => $credito->numero_coutas,
                'totalInteres' => number_format($credito->total_interes, 2),
                'totalPagar' => number_format($credito->total_pagar, 2),
                'formaPago' => $forma_pago,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function pdfPagosEstado($estado = null, $fechaInicio = null, $fechaFin = null)
    {
        $this->load->library('pdf');
        if ($estado == 0) {
            //TODOS
            $creditos = $this->prestamos_model->getPagosEstadoAll($fechaInicio, $fechaFin);
        } elseif ($estado == 1) {
            //PENDIENTES
            $creditos = $this->prestamos_model->getCuotasPendientesFechas($fechaInicio, $fechaFin);
        } elseif ($estado == 2) {
            //PAGAN HOY
            $creditos = $this->prestamos_model->getCoutasPaganHoy();
        } elseif ($estado == 3) {
            //VENCIDOS
            $creditos = $this->prestamos_model->getCoutasVencidasFechas();
        } elseif ($estado == 4) {
            //CANCELADOS
            $creditos = $this->prestamos_model->getCoutasCanceladasFechas($fechaInicio, $fechaFin);
        }
        // echo "<pre>";
        // print_r($creditos);
        // exit();
        $file_name = "LISTA DE PAGOS POR ESTADO Y FECHAS";
        $data = array(
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $creditos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_pagos_estado', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');

    }

    public function getPagosEstadoFechas()
    {

        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFin = $this->input->post('fechaFin');
        $estado = $this->input->post('estado');
        if ($estado == 0) {
            //TODOS
            $creditos = $this->prestamos_model->getPagosEstadoAll($fechaInicio, $fechaFin);
        } elseif ($estado == 1) {
            //PENDIENTES
            $creditos = $this->prestamos_model->getCuotasPendientesFechas($fechaInicio, $fechaFin);
        } elseif ($estado == 2) {
            //PAGAN HOY
            $creditos = $this->prestamos_model->getCoutasPaganHoy();
        } elseif ($estado == 3) {
            //VENCIDOS
            $creditos = $this->prestamos_model->getCoutasVencidasFechas();
        } elseif ($estado == 4) {
            //CANCELADOS
            $creditos = $this->prestamos_model->getCoutasCanceladasFechas($fechaInicio, $fechaFin);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $fecha_cuota = $credito->fecha_couta;
            $estado_cuota = $credito->estado_couta;
            $fechaAtual = strtotime(date('Y-m-d'));
            $fechaVencimiento = strtotime($fecha_cuota);
            $estado = '';
            if ($estado_cuota == 1) {
                if ($fechaAtual == $fechaVencimiento) {
                    $estado = '<span class="badge  badge-primary mb-1"><i class="fas fa-info-circle"></i> PAGA HOY</span>';
                }
                if ($fechaAtual > $fechaVencimiento) {
                    $estado = '<span class="badge  badge-danger mb-1"><i class="fas fa-exclamation-triangle"></i> VENCIDO</span>';
                }
                if ($fechaAtual < $fechaVencimiento) {
                    $estado = '<span class="badge  badge-warning mb-1"><i class="fas fa-info-circle"></i> POR COBRAR</span>';
                }
            } else {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check"></i> PAGADO</span>';
            }

            $data[] = [
                'id' => $i,
                'idcredito' => $credito->idcredito,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'fecha_cuota' => formatoFechaCorta($credito->fecha_couta),
                'numero_cuota' => $credito->numero_couta,
                'fecha_pago' => ($credito->fecha_pago == "" ? '' : formatoFechaCorta($credito->fecha_pago)),
                'monto_pagado' => $credito->monto_pagado,
                'monto_cuota' => $credito->monto_cuota,
                'monto_pendiente' => $credito->monto_pendiente,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function getCreditosFechasAsesorEstado()
    {
        $fechaInicio = explode("/", $this->input->post('fechaInicio'));
        krsort($fechaInicio);
        $fechaInicio = implode("-", $fechaInicio);

        $fechaFin = explode("/", $this->input->post('fechaFin'));
        krsort($fechaFin);
        $fechaFin = implode("-", $fechaFin);

        $idasesor = $this->input->post('idasesor');
        $estado = $this->input->post('estado');

        if (empty($fechaInicio) && empty($fechaFin)) {
            $creditos = $this->prestamos_model->get_all();
        } else {
            if ($estado == 3) {
                if ($idasesor == "0") {
                    $creditos = $this->prestamos_model->getByDatesTodos($fechaInicio, $fechaFin);
                } else {
                    $creditos = $this->prestamos_model->getByDatesAsesorTodos($fechaInicio, $fechaFin, $idasesor);
                }
                //$creditos = $this->prestamos_model->getByDatesAsesorTodos($fechaInicio, $fechaFin, $idasesor);
            } else {
                if ($idasesor == 0) {
                    $creditos = $this->prestamos_model->getByDatesEstado($fechaInicio, $fechaFin, $estado);
                } else {
                    $creditos = $this->prestamos_model->getByDatesAsesorEstado($fechaInicio, $fechaFin, $idasesor, $estado);
                }
                //$creditos = $this->prestamos_model->getByDatesAsesorEstado($fechaInicio, $fechaFin, $idasesor, $estado);
            }
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $forma_pago = '';
            if ($credito->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($credito->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($credito->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($credito->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';

            if ($credito->estado == 0) {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check-circle"></i> PAGADO</span>';
            }
            if ($credito->estado == 1) {
                $estado = '<span class="badge badge-primary mb-1"><i class="fas fa-sync-alt"></i> POR COBRAR</span>';
            }

            $data[] = [
                'id' => $i,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'idCredito' => $credito->id,
                'fechaCredito' => $credito->fecha_credito,
                'montoCredito' => $credito->monto_credito,
                'interes' => $credito->interes_credito,
                'coutas' => $credito->numero_coutas,
                'totalInteres' => $credito->total_interes,
                'totalPagar' => $credito->total_pagar,
                'formaPago' => $forma_pago,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function getEstadoCuentaCliente()
    {
        $cliente_id = $this->input->post('clienteid');
        $creditos = $this->prestamos_model->getAllCuotasCliente($cliente_id);
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $fecha_cuota = $credito->fecha_couta;
            $estado_cuota = $credito->estado_couta;
            $fechaAtual = strtotime(date('Y-m-d'));
            $fechaVencimiento = strtotime($fecha_cuota);
            $estado = '';
            if ($estado_cuota == 1) {
                if ($fechaAtual == $fechaVencimiento) {
                    $estado = '<span class="badge  badge-primary mb-1"><i class="fas fa-info-circle"></i> PAGA HOY</span>';
                }
                if ($fechaAtual > $fechaVencimiento) {
                    $estado = '<span class="badge  badge-danger mb-1"><i class="fas fa-exclamation-triangle"></i> VENCIDO</span>';
                }
                if ($fechaAtual < $fechaVencimiento) {
                    $estado = '<span class="badge  badge-info mb-1"><i class="fas fa-info-circle"></i> POR COBRAR</span>';
                }
            } else {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check"></i> PAGADO</span>';
            }
            $data[] = [
                'id' => $i,
                'idcredito' => $credito->idcredito,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'fechaCuota' => $credito->fecha_couta,
                'numerCuota' => $credito->numero_couta,
                'montoCuota' => $credito->monto_cuota,
                'montoPendiente' => $credito->monto_pendiente,
                'fechaPago' => $credito->fecha_pago,
                'montoPago' => $credito->monto_pagado,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function getEstadoCuentaClienteFecha()
    {
        $cliente_id = $this->input->post('clienteid');
        $fecha = $this->input->post('fecha');
        $creditos = $this->prestamos_model->getAllCuotasClienteFechaPago($cliente_id, $fecha);
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $fecha_cuota = $credito->fecha_couta;
            $estado_cuota = $credito->estado_couta;
            $fechaAtual = strtotime(date('Y-m-d'));
            $fechaVencimiento = strtotime($fecha_cuota);
            $estado = '';
            if ($estado_cuota == 1) {
                if ($fechaAtual == $fechaVencimiento) {
                    $estado = '<span class="badge  badge-primary mb-1"><i class="fas fa-info-circle"></i> PAGA HOY</span>';
                }
                if ($fechaAtual > $fechaVencimiento) {
                    $estado = '<span class="badge  badge-danger mb-1"><i class="fas fa-exclamation-triangle"></i> VENCIDO</span>';
                }
                if ($fechaAtual < $fechaVencimiento) {
                    $estado = '<span class="badge  badge-info mb-1"><i class="fas fa-info-circle"></i> POR COBRAR</span>';
                }
            } else {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check"></i> PAGADO</span>';
            }
            $data[] = [
                'id' => $i,
                'idcredito' => $credito->idcredito,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'fechaCuota' => $credito->fecha_couta,
                'numerCuota' => $credito->numero_couta,
                'montoCuota' => $credito->monto_cuota,
                'montoPendiente' => $credito->monto_pendiente,
                'fechaPago' => $credito->fecha_pago,
                'montoPago' => $credito->monto_pagado,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function pdffechas($fechaInicio, $fechaFin, $idcliente, $idasesor)
    {
        $this->load->library('pdf');
        $file_name = "";
        if (empty($fechaInicio) && empty($fechaFin)) {
            $prestamos = $this->prestamos_model->get_all();
            $file_name = "RESUMEN DE CRÉDITOS";
        } else {
            if ($idasesor == 0) {
                $prestamos = $this->prestamos_model->getByDatesNoAsesor($fechaInicio, $fechaFin, $idcliente);
            } else {
                $prestamos = $this->prestamos_model->getByDates($fechaInicio, $fechaFin, $idcliente, $idasesor);
            }
            $file_name = "RESUMEN DE CRÉDITOS DEL - " . $fechaInicio . " AL " . $fechaFin;
        }
        $empresa = $this->core_model->get_by_id('tb_sistema', array('id' => 1));
        $data = array(
            'empresa' => $empresa,
            'prestamos' => $prestamos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/pdf_creditos_fechas_cliente_asesor', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');

    }

    public function pdffechas2($fechaInicio, $fechaFin, $idcliente, $idasesor)
    {
        $this->load->library('pdf');
        $file_name = "";
        if (empty($fechaInicio) && empty($fechaFin)) {
            $prestamos = $this->prestamos_model->get_all();
            $file_name = "RESUMEN DE CRÉDITOS";
        } else {
            if ($idasesor == 0) {
                $prestamos = $this->prestamos_model->getByDatesNoAsesor($fechaInicio, $fechaFin, $idcliente);
            } else {
                $prestamos = $this->prestamos_model->getByDates($fechaInicio, $fechaFin, $idcliente, $idasesor);
            }
            $file_name = "RESUMEN DE CRÉDITOS DEL - " . $fechaInicio . " AL " . $fechaFin;
        }
        $data = array(
            'prestamos' => $prestamos,
            'titulo' => $file_name
        );
        $i = 0;
        $total_credito = 0;
        $total_interes = 0;
        $total_pagar = 0;

        $html = '<html style="font-size:10px>"';
        $html .= '<head>';
        $html .= '<title></title>';
        $html .= "<style>
		body {
			margin: 3px;
		}

		html {
			font-size: 12px/1;
			font-family: 'CyberCJK', sans-serif;
			overflow: auto;
		}

		table {
			color: #333;
			font-family: Arial, Arial, sans-serif;
			width: 100%;
			border-collapse: collapse;
		}

		td,
		th {
			border: 1px solid #666;
			padding: 8px;
			height: 30px;
		}

		th {
			background: #D3D3D3;
			font-weight: bold;
		}

		td {
			background: #FAFAFA;
			text-align: center;
		}

		.titulo {
			text-align: center;
			font-size: 12px;
		}
		</style>";

        $html .= '</head>';
        $html .= '<body>';
        $html .= "<table>";
        $html .= '<tr>
		<th colspan="13" class="titulo">' . $file_name . '</th>
		</tr>
		<tr>
		<th>Orden</th>
		<th>Cliente</th>
		<th>Asesor</th>
		<th>F.Cuota</th>
		<th>Monto Crédito</th>
		<th>Interes</th>
		<th>Cuotas Pagadas</th>
		<th>Cuotas Pendientes</th>
		<th>Total Interes</th>
		<th>Total Pagar</th>
		<th>Forma de Pago</th>
		<th>Estado</th>
		<th>Teléfono</th>
		</tr>
		</thead>';
        $html .= "<tbody>";
        foreach ($prestamos as $prestamo) {
            $i++;
            $forma_pago = '';
            if ($prestamo->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($prestamo->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($prestamo->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($prestamo->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';
            if ($prestamo->estado == 0) {
                $estado = 'PAGADO';
            } elseif ($prestamo->estado == 1) {
                $estado = 'POR COBRAR';
            }
            $total_credito = $total_credito + $prestamo->monto_credito;
            $total_interes = $total_interes + $prestamo->total_interes;
            $total_pagar = $total_pagar + $prestamo->total_pagar;
            $cuotasPendientes = $this->prestamos_model->getContarCuotasPendientes($prestamo->id);
            $pendientes = $cuotasPendientes->CuotasPendientes;
            $cuotasPagadas = $this->prestamos_model->getContarCuotasPagadas($prestamo->id);
            //var_dump($cuotasPagadas);
            $pagadas = $cuotasPagadas->CuotasPagadas;
            $html .= "<tr>
			<td>" . $i . "</td>
			<td>" . $prestamo->apellidos . ', ' . $prestamo->nombres . "</td>
			<td>" . $prestamo->nombre_asesor . "</td>
			<td>" . $prestamo->fecha_credito . "</td>
			<td>" . $prestamo->monto_credito . "</td>
			<td>" . $prestamo->interes_credito . '%' . "</td>
			<td>" . $pagadas . "</td>
			<td>" . $pendientes . "</td>
			<td>" . $prestamo->total_interes . "</td>
			<td>" . $prestamo->total_pagar . "</td>
			<td>" . $forma_pago . "</td>
			<td>" . $estado . "</td>
			<td>" . $prestamo->telefono . "</td>
			</tr>";
        }
        $html .= '<tr>
		<td colspan="4">TOTAL CRÉDITO</td>

		<td>' . number_format($total_credito, 2) . '</td>
		<td colspan="3">TOTAL INTERES</td>

		<td>' . number_format($total_interes, 2) . '</td>
		<td>' . number_format($total_pagar, 2) . '</td>

		<td></td>
		<td></td>
		<td></td>

		</tr>';
        $html .= "</tbody>";
        $html .= "</table>";
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');
    }

    public function excel($fechaInicio, $fechaFin)
    {
        // echo '<pre>';
        // print_r($fechaFin);
        // exit();
        // $fechaInicio =  explode("/", $fechaInicio);
        // krsort($fechaInicio);
        // $fechaInicio = implode("-", $fechaInicio);

        // $fechaFin =  explode("/", $fechaFin);
        // krsort($fechaFin);
        // $fechaFin = implode("-", $fechaFin);
        $file_name = "";
        if (empty($fechaInicio) && empty($fechaFin)) {
            $prestamos = $this->prestamos_model->get_all();
            $file_name = "RESUMEN DE PRESTAMOS";
        } else {
            $prestamos = $this->prestamos_model->getByDates($fechaInicio, $fechaFin);
            $file_name = "RESUMEN DE PRESTAMOS DEL - " . $fechaInicio . " AL " . $fechaFin;
        }

        //$file_name = "RESUMEN DE PRESTAMMOS";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
        $sheet->getStyle('F1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
        $sheet->getStyle('H1')->getFont()->setBold(true);
        $sheet->getStyle('I1')->getFont()->setBold(true);
        $sheet->getStyle('J1')->getFont()->setBold(true);
        $sheet->setCellValue('A1', 'FECHA CRÉDITO');
        $sheet->setCellValue('B1', 'CLIENTE');
        $sheet->setCellValue('C1', 'MONTO CRÉDITO');
        $sheet->setCellValue('D1', 'INTERES');
        $sheet->setCellValue('E1', 'MONTO INTERES');
        $sheet->setCellValue('F1', 'COUTAS');
        $sheet->setCellValue('G1', 'MONTO CUOTA');
        $sheet->setCellValue('H1', 'TOTAL A PAGAR');
        $sheet->setCellValue('I1', 'FORMA DE PAGO');
        $sheet->setCellValue('J1', 'ESTADO');
        foreach (range('A', 'B') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $rows = 2;
        foreach ($prestamos as $prestamo) {
            $forma_pago = '';
            if ($prestamo->forma_pago == 0) {
                $forma_pago = 'DIARIO';
            } elseif ($prestamo->forma_pago == 1) {
                $forma_pago = 'SEMANAL';
            } elseif ($prestamo->forma_pago == 2) {
                $forma_pago = 'QUINCENAL';
            } elseif ($prestamo->forma_pago == 3) {
                $forma_pago = 'MENSUAL';
            }
            $estado = '';
            if ($prestamo->estado == 0) {
                $estado = 'PAGADO';
            } elseif ($prestamo->estado == 1) {
                $estado = 'POR COBRAR';
            }
            $sheet->setCellValue('A' . $rows, $prestamo->fecha_credito);
            $sheet->setCellValue('B' . $rows, $prestamo->apellidos . ', ' . $prestamo->nombres);
            $sheet->setCellValue('C' . $rows, $prestamo->monto_credito);
            $sheet->setCellValue('D' . $rows, $prestamo->interes_credito . '%');
            $sheet->setCellValue('E' . $rows, $prestamo->total_interes);
            $sheet->setCellValue('F' . $rows, $prestamo->numero_coutas);
            $sheet->setCellValue('G' . $rows, $prestamo->monto_couta);
            $sheet->setCellValue('H' . $rows, $prestamo->total_pagar);
            $sheet->setCellValue('I' . $rows, $forma_pago);
            $sheet->setCellValue('J' . $rows, $estado);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function pdfClientePagos($idcliente, $fechaInicio1, $fechaFin1)
    {
        $this->load->library('pdf');
        $fechaInicio = $fechaInicio1;
        $fechaFin = $fechaFin1;

        if ($idcliente == 0) {
            $creditos = $this->prestamos_model->getPagosClienteAll($fechaInicio, $fechaFin);
        } else {
            $creditos = $this->prestamos_model->getPagosCliente($idcliente, $fechaInicio, $fechaFin);
        }

        $file_name = "LISTA DE PAGOS POR CLIENTE Y ESTADO";
        $data = array(
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $creditos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_pagos_cliente', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');

    }

    public function getPagosCliente()
    {
        $fechaInicio = explode("/", $this->input->post('fechaInicio'));
        krsort($fechaInicio);
        $fechaInicio = implode("-", $fechaInicio);

        $fechaFin = explode("/", $this->input->post('fechaFin'));
        krsort($fechaFin);
        $fechaFin = implode("-", $fechaFin);
        $idcliente = $this->input->post('idcliente');

        if ($idcliente == 0) {
            $creditos = $this->prestamos_model->getPagosClienteAll($fechaInicio, $fechaFin);
        } else {
            $creditos = $this->prestamos_model->getPagosCliente($idcliente, $fechaInicio, $fechaFin);
        }
        $i = 0;
        $data = [];
        foreach ($creditos as $credito) {
            $i++;
            $fecha_cuota = $credito->fecha_couta;
            $estado_cuota = $credito->estado_couta;
            $fechaAtual = strtotime(date('Y-m-d'));
            $fechaVencimiento = strtotime($fecha_cuota);
            $estado = '';
            if ($estado_cuota == 1) {
                if ($fechaAtual == $fechaVencimiento) {
                    $estado = '<span class="badge  badge-primary mb-1"><i class="fas fa-info-circle"></i> PAGA HOY</span>';
                }
                if ($fechaAtual > $fechaVencimiento) {
                    $estado = '<span class="badge  badge-danger mb-1"><i class="fas fa-exclamation-triangle"></i> VENCIDO</span>';
                }
                if ($fechaAtual < $fechaVencimiento) {
                    $estado = '<span class="badge  badge-info mb-1"><i class="fas fa-info-circle"></i> POR COBRAR</span>';
                }
            } else {
                $estado = '<span class="badge  badge-success mb-1"><i class="fas fa-check"></i> PAGADO</span>';
            }

            $data[] = [
                'id' => $i,
                'idcredito' => $credito->idcredito,
                'cliente' => $credito->apellidos . ', ' . $credito->nombres,
                'asesor' => $credito->nombre_asesor,
                'fecha_cuota' => $credito->fecha_couta,
                'numero_cuota' => $credito->numero_coutas,
                'fecha_pago' => $credito->fecha_pago,
                'monto_pagado' => $credito->monto_pagado,
                'monto_cuota' => $credito->monto_couta,
                'monto_pendiente' => $credito->monto_pendiente,
                'estado' => $estado
            ];
        }
        $retorna = [
            'data' => $data,
        ];
        echo json_encode($retorna);
    }

    public function pdfPagosAsesor($idasesor, $fechaInicio, $fechaFin)
    {
        $this->load->library('pdf');
        if ($idasesor == "0") {
            $creditos = $this->prestamos_model->getPagosAllAsesor($fechaInicio, $fechaFin);

        } else {
            $creditos = $this->prestamos_model->getPagosAsesor($idasesor, $fechaInicio, $fechaFin);
        }

        $file_name = "LISTA DE PAGOS POR ASESOR";
        $data = array(
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $creditos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_pagos_asesor', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');

    }

    public function pdfCreditosCliente($cliente_id)
    {
        $this->load->library('pdf');
        $prestamos = $this->prestamos_model->getCreditoByCliente($cliente_id);
        $file_name = "LISTA DE CRÉDITOS POR CLIENTE";
        $data = array(
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $prestamos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_creditos_cliente', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');
    }

    public function pdfCreditosAsesor($idasesor)
    {
        $this->load->library('pdf');
        if ($idasesor == 0) {
            $prestamos = $this->prestamos_model->getCreditosByAll();
        } else {
            $prestamos = $this->prestamos_model->getCreditoByAsesor($idasesor);
        }

        $file_name = "LISTA DE CRÉDITOS POR ASESOR";
        $data = array(
            'empresa' => $empresa = $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $prestamos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_creditos_cliente', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');
    }

    public function pdfCreditosAsesorEstado($fechaInicio, $fechaFin, $idasesor, $estado)
    {
        $this->load->library('pdf');

        if (empty($fechaInicio) && empty($fechaFin)) {
            $creditos = $this->prestamos_model->get_all();
        } else {
            if ($estado == 3) {
                if ($idasesor == "0") {
                    $creditos = $this->prestamos_model->getByDatesTodos($fechaInicio, $fechaFin);
                } else {
                    $creditos = $this->prestamos_model->getByDatesAsesorTodos($fechaInicio, $fechaFin, $idasesor);
                }
                //$creditos = $this->prestamos_model->getByDatesAsesorTodos($fechaInicio, $fechaFin, $idasesor);
            } else {
                if ($idasesor == 0) {
                    $creditos = $this->prestamos_model->getByDatesEstado($fechaInicio, $fechaFin, $estado);
                } else {
                    $creditos = $this->prestamos_model->getByDatesAsesorEstado($fechaInicio, $fechaFin, $idasesor, $estado);
                }
                //$creditos = $this->prestamos_model->getByDatesAsesorEstado($fechaInicio, $fechaFin, $idasesor, $estado);
            }
        }

        $file_name = "LISTA DE CRÉDITOS POR ASESOR";
        $data = array(
            'empresa' => $this->core_model->get_by_id('tb_sistema', array('id' => 1)),
            'prestamos' => $creditos,
            'titulo' => $file_name
        );
        $html = $this->load->view('reportes/export_pdf_creditos_cliente', $data, TRUE);
        $this->pdf->createPDF($html, $file_name, false, 'A4', 'landscape');
    }
}

