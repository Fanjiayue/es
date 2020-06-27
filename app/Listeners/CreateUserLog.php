<?php

namespace App\Listeners;

use App\Events\Register;



class CreateUserLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(Register $event)
    {
        $data = $event->text;
        switch ($data['artsion']){
            case 'index':
                $re = $this->index($data);
                return $re;
            case 'bulk':
                $re = $this->bulk($data);
                return $re;
            case 'get':
                $re = $this->get($data);
                return $re;
            case 'update':
                $re = $this->update($data);
                return $re;
            case 'search':
                $re = $this->search($data);
                return $re;
            case 'delete':
                $re = $this->delete($data);
                return $re;
            default:
                return false;
        }

    }

    protected function index($data)
    {
        $params = [
            'index' => 'twitter',
            'body'  => $data['body']
        ];
        $re = app('es')->index($params);
        return $re;
    }

    protected function bulk($data)
    {
       foreach ($data['params'] as $k=>$v){
           $params['body'][] =[
               'index' => [
                   '_index' => 'twitter',
               ]
           ];
           $params['body'][] = $v['body'];
       }
       if(!empty($params)){
           $re = app('es')->bulk($params);
           return $re;
       }else{
           return false;
       }
    }

    protected function get($data)
    {
        $params = [
            'index' => 'twitter',
            'id'    => $data['id']
        ];
        $re = app('es')->get($params);
        return $re;
    }

    protected function update($data)
    {
        $params = [
            'index' => 'twitter',
            'id'    => $data['id'],
            'body'  => $data['body']
        ];
        $re = app('es')->update($params);
        return $re;
    }

    protected function search($data)
    {
        $params = [
            'index' => 'twitter',
            'scroll' => $data['page'].'m',
            'size'=>$data['pageSize'],
            'body'  => [
                'query' => $data['field']

            ]
        ];
        $re = app('es')->search($params);
        return $re;

    }

    protected function delete($data)
    {
        $params = [
            'index' => 'twitter',
            'id'    => $data['id']
        ];
        $re = app('es')->delete($params);
        return $re;

    }

}
