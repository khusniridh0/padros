<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function random_uuid(){
    $case = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $case = str_shuffle($case);
    return substr($case, 0, 20);
}

function verify_code(){
    for ($i=0; $i < 6; $i++) { 
        $code[$i] = rand(1, 9);
    }

    return join($code);
}

function random_password() {
    $pass = random_uuid();
    return substr($pass, 0, 8);
}

function is_login(){
    $ci = get_instance();
    if (empty($ci->session->userdata('user'))) {
        return false;
    }

    if (empty($ci->session->userdata('name'))) {
        return false;
    }

    if (empty($ci->session->userdata('image'))) {
        return false;
    }

    if (empty($ci->session->userdata('email'))) {
        return false;
    }

    if (empty($ci->session->userdata('phone'))) {
        return false;
    }

    if (empty($ci->session->userdata('role'))) {
        return false;
    }

    return true;
}

function is_admin(){
    $ci = get_instance();
    if ($ci->session->userdata('role') == 1 or $ci->session->userdata('role') == 2) {
        return true;
    }
    
    return false;
}

function is_owner(){
    $ci = get_instance();
    if ($ci->session->userdata('role') == 1) {
        return true;
    }
    
    return false;
}

function is_employee(){
    $ci = get_instance();
    if ($ci->session->userdata('role') == 2) {
        return true;
    }
    
    return false;
}

function is_customer(){
    $ci = get_instance();
    if ($ci->session->userdata('role') == 3) {
        return true;
    }
    
    return false;
}

function email_send($email, $message, $subject){
    $ci = get_instance();
    $ci->load->library('email');
    $config['protocol'] = 'smtp';
    $config['priority'] = 1;
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_user'] = 'suryakesuma63@gmail.com';
    $config['smtp_pass'] = 'dhawaqadrvvjptik';
    $config['smtp_port'] = 465;
    $config['smtp_crypto'] = 'ssl'; 
    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    $config['newline'] = "\r\n";

    $ci->email->initialize($config);

    $ci->email->from('Padros Studio');
    $ci->email->to($email);
    $ci->email->subject($subject);
    $ci->email->message($message);

    if (!$ci->email->send()) {
        return false;
    }
    return true;
}

function flashmessage($tipe, $pesan){
    $ci = get_instance();
    $ci->session->set_flashdata('warning', '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert"> ' . $pesan . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
}

function end_date($date) {
    $date = date('Y-m-d', strtotime($date));
    $year = date('Y', strtotime($date));
    $month = date('m', strtotime($date));
    $end = date('Y-m-t', strtotime($year . '-' . $month . '-01'));

    if ($date <= $end) {
        return $end;
    } else {
        return false;
    }
}

function date_now() {
    $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $month = $monthNames[round(date('m')) - 1];
    return date('d ') . $month . date(' Y');
}

function set_date($date) {
    $time = explode(' ', $date);
    $date = $time[0];
    $month = $time[1];
    $year = $time[2];
    $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $date = $year . '0' . array_search($month, $monthNames) + 1 . '-' . $date;
    return date('Y-m-d', strtotime($date));
}

function present($data, $target, $type = true){
    $count = count($data);
    $matched = 0;

    foreach ($data as $item) {
        $date_created = new DateTime($item['date_created']);
        if ($date_created->format('Y-m-d') === $target) {
            $matched++;
        }
    }

    $next_present = ($matched / $count) * 100;

    $count = (int) $target - 1;
    $matched = 0;

    foreach ($data as $item) {
        $date_created = new DateTime($item['date_created']);
        if ($date_created->format('Y-m-d') === (string) $count) {
            $matched++;
        }
    }

    $prev_present = ($matched / $count) * 100;
    
    if ($type){
        if ($next_present > $prev_present) {
            return ['status' => 'text-success', 'message' => 'Meningkat', 'present' => round($next_present)];
        } elseif ($next_present < $prev_present) {
            return ['status' => 'text-danger', 'message' => 'Menurun', 'present' => round($next_present)];
        } else {
            return ['status' => 'text-danger', 'message' => 'Menurun', 'present' => round($next_present)];
        }
    } else {
        return $prev_present;
    }
}

function graphicDash($data) {
    $categories = ['','','','','','',''];
    $count = [0, 0, 0, 0, 0, 0, 0];
    for ($i=0; $i < 7; $i++) { 
        $weeks = date('Y-m-d', strtotime(date('Y-m-d') . ' -'.$i.' day'));
        $categories[$i] = $weeks;
        foreach ($data as $item) {
            $date = new DateTime($item['date_created']);
            if ($date->format('Y-m-d') === $weeks) {
                $count[$i] += 1;
            }
        }
    }
    return [$count, $categories];
}

function graphic() {
    $data = date('Y-m-d');
    $categories = ['','','','','','',''];
    $count = [0, 0, 0, 0, 0, 0, 0];
    for ($i=0; $i < 7; $i++) { 
        $weeks = date('Y-m-d', strtotime(date('Y-m-d') . ' -'.$i.' day'));
        $categories[$i] = $weeks;
    }
    return [$categories];
}

function sortASC($a, $b) {
    return strtotime($a['date_created']) - strtotime($b['date_created']);
}