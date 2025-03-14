<?php
class Envio {
    private $peso;
    private $servicio;
    private $valorDeclarado;
    private $costoBase;
    private $recargoServicio;
    private $seguro;
    private $iva;
    private $total;

    public function __construct($peso, $servicio, $valorDeclarado) {
        $this->peso = $peso;
        $this->servicio = $servicio;
        $this->valorDeclarado = $valorDeclarado;
    }

    private function calcularCostoBase() {
        if ($this->peso < 1) {
            $this->costoBase = 5000;
        } elseif ($this->peso <= 5) {
            $this->costoBase = 10000;
        } elseif ($this->peso <= 10) {
            $this->costoBase = 20000;
        } else {
            $this->costoBase = 30000;
        }
    }

    private function calcularRecargoServicio() {
        switch ($this->servicio) {
            case 'economico':
                $this->recargoServicio = $this->costoBase * 0.05;
                break;
            case 'estandar':
                $this->recargoServicio = $this->costoBase * 0.10;
                break;
            case 'express':
                $this->recargoServicio = $this->costoBase * 0.20;
                break;
            case 'prioritario':
                $this->recargoServicio = $this->costoBase * 0.30;
                break;
            case 'internacional':
                $this->recargoServicio = $this->costoBase * 0.50;
                break;
            default:
                $this->recargoServicio = 0;
        }
    }

    private function calcularSeguro() {
        if ($this->valorDeclarado > 100000) {
            $this->seguro = $this->valorDeclarado * 0.05;
        } else {
            $this->seguro = 0;
        }
    }

    private function calcularIVA() {
        $subtotal = $this->costoBase + $this->recargoServicio + $this->seguro;
        $this->iva = $subtotal * 0.19;
    }

    public function calcularCostoTotal() {
        $this->calcularCostoBase();
        $this->calcularRecargoServicio();
        $this->calcularSeguro();
        $this->calcularIVA();

        $this->total = $this->costoBase + $this->recargoServicio + $this->seguro + $this->iva;
        return $this->total;
    }

    public function obtenerDetalles() {
        return [
            "Costo Base" => $this->costoBase,
            "Recargo Servicio" => $this->recargoServicio,
            "Seguro" => $this->seguro,
            "IVA (19%)" => $this->iva,
            "Total a Pagar" => $this->total
        ];
    }
}
?>
