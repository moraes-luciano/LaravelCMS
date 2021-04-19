<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Page;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
  
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $interval = intval($request->input('interval',1));
        

        // $ipAddress = $request->ip();

    
        //Contagem de Visitantes
        if($interval > 15){
            $interval = 15;
        }
        //Para mostar os visitantes dos ultimos 15 dias
        //$dateInterval = date('Y-m-d H:i:s', strtotime('-'.$interval.'days')); 

        // Para o uso, trocar pelo comando equivalente acima
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$interval.'years')); 
        $visitsCount = Visitor::where('date_access', '>=',$dateInterval)->count();


        //Contagem de Usuários Online
        
        // Para estimar em cinco minutos 
        // $dateLimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));

        // Apenas para demonstrar a funcionalidade, para o uso trocar para o comando equivalente acima
        $dateLimit = date('Y-m-d H:i:s', strtotime('-5 years'));
        $onlineList = Visitor::select('ip')->where('date_access','>=',$dateLimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);



        //Contagem de Páginas
        $pageCount = Page::count();

        //Contagem de Usuários
        $userCount = User::count();

        //Contagem para o PagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')
            ->where('date_access', '>=',$dateInterval)
            ->groupBy('page')
        ->get();
        foreach($visitsAll as $visit){
            $pagePie[$visit ['page']] = intval($visit['c']);
        }

        

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));
        
        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,  
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'dateInterval' => $interval
        ]);
    }
}
