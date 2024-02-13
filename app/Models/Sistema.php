<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sistema extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha'      => 'date:d/m/Y'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cerrar($id){
        try {
            DB::beginTransaction();

            $sistema = Sistema::find($id);
            $sistema->estado = 2;
            $sistema->save();

            $user = auth()->user()->id;

            $f_mes = fecha_mes();
            if(date('Y-m-d', strtotime($sistema->fecha)) == $f_mes){
                $fecha_inventario = Inventario::orderByDesc('id')->select('mes','anio')->take(1)->first();

                $mes = date('m', strtotime($f_mes));
                $anio = date('Y', strtotime($f_mes));
                foreach(Sucursal::get() as $suc){
                    $articulos = Articulo::where('articulos.created_at','<=',$f_mes)
                            ->join('stocks as s','articulos.id','s.articulo_id')
                            ->where('s.sucursal_id', $suc->id)
                            ->select('articulos.id',
                                DB::raw(" (select (inicio + comprado) - (descartado + vendido) from inventarios 
                                            where articulo_id = articulos.id and sucursal_id=$suc->id 
                                            and mes='$fecha_inventario->mes' and anio='$fecha_inventario->anio') as inicio "),
                                DB::raw(" (select sum(cantidad) from detallecompras dc join compras c on dc.compra_id = c.id
                                                where dc.articulo_id = articulos.id and c.sucursal_id=$suc->id and c.estado=1 and dc.estado=1 
                                                and MONTH(c.fecha) = '$mes' and YEAR(c.fecha) = '$anio' ) as compras "),
                                //Ventas individuales
                                DB::raw(" (select sum(cantidad) from detalleventas dv join ventas v on dv.venta_id = v.id
                                                where dv.articulo_id = articulos.id and v.sucursal_id=$suc->id and v.estado=1 and MONTH(v.fecha) = '$mes' 
                                                and YEAR(v.fecha) = '$anio' AND dv.tipoventa=1) as ventas "),
                                //Ventas en promocion mas de 1 articulo
                                DB::raw(" (select sum(cantidad) from detalleventas dv join ventas v on dv.venta_id = v.id
                                                join promocions p on dv.articulo_id = p.id 
                                                join detallepromocions dp on p.id = dp.promocion_id
                                                where dp.articulo_id = articulos.id and v.sucursal_id=$suc->id and v.estado=1 and MONTH(v.fecha) = '$mes' 
                                                and YEAR(v.fecha) = '$anio' AND dv.tipoventa=2) as ventasPromo "),
                                DB::raw(" (select sum(cantidad) from movimientos where articulo_id = articulos.id and sucursal_id=$suc->id and estado=1 
                                            and MONTH(fecha) = '$mes' and YEAR(fecha) = '$anio' and tipo=1) as salidas "),
                                DB::raw(" (select sum(cantidad) from movimientos where articulo_id = articulos.id and sucursal_id=$suc->id and estado=1 
                                            and MONTH(fecha) = '$mes' and YEAR(fecha) = '$anio' and tipo=2) as ingresos ")

                                )
                            ->get();

                    foreach($articulos as $art){
                        $inventario = new Inventario();
                        $inventario->user_id     = $user;
                        $inventario->sucursal_id = $suc->id;
                        $inventario->mes         = $mes;
                        $inventario->anio        = $anio;
                        $inventario->articulo_id = $art->id;
                        $inventario->inicio      = 0 + $art->inicio;
                        $inventario->comprado    = 0 + ($art->compras + $art->ingresos);
                        $inventario->descartado  = 0 + $art->salidas;
                        $inventario->vendido     = 0 + $art->ventas + $art->ventasPromo;
                        $inventario->save();
                    }
                }
            }

            //Finalizar promociones 
            Promocion::where('estado', 1)->where('fecha_fin','<=', $sistema->fecha)->update([
                'estado' => 2
            ]);
            
            //Finalizar descuentos 
            Descuento::where('estado', 1)->where('fecha_fin','<=',$sistema->fecha)->update([
                'estado' => 0
            ]);

            $this->user_id = $user;
            $this->fecha = date("Y-m-d",strtotime($sistema->fecha . "+ 1 days"));
            $this->fechacierre = new \Datetime();
            $this->save();

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

}
