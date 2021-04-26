<?php

namespace App\Controllers;

use App\Models\MedicModel;
use App\Models\MedicSpecialtyModel;
use App\Models\SpecialtyModel;
use App\Config\Router;
use function App\Helpers\onlyNumbers;
use function \App\Helpers\setError;
use function \App\Helpers\setSuccess;
use function \App\Helpers\redirect;

/**
 * Classe MedicController
 * @author Jonatas Ramos
 *
 * Classe responsável pelo controle de Médicos
 */
final class MedicController extends BaseController
{
    /**
     * Carrega a página inicial do Médico
     */
    public function index()
    {
        $MedicModel = new MedicModel();
        $data = [
            'title' => 'Médicos',
            'medics' => $MedicModel->find()
        ];
        return self::view('medic/index', $data);
    }

    /**
     * Carrega a página de cadastro de clientes
     */
    public function create()
    {
        $SpecialtyModel = new SpecialtyModel();
        $specialty = $SpecialtyModel->find();

        $data = [
            'title' => 'Novo Médico',
            'specialty' => $specialty
        ];
        return self::view('medic/create', $data);
    }

    /**
     * Carrega a página de edição de médicos
     */
    public function edit() {
        $data = Router::getRequest();
        $id = base64_decode(strrev($data['i']));
        if ($id) {
            $SpecialtyModel = new SpecialtyModel();
            $MedicModel = new MedicModel();
            $MedicSpecialtyModel = new MedicSpecialtyModel();

            $specialty = $SpecialtyModel->find();
            $medic = $MedicModel->findById($id);
            $medic_specialty = $MedicSpecialtyModel->findWithSpecialty($id);

            $data = [
                'id' => $id,
                'title' => 'Editar Médico',
                'medic' => $medic[0],
                'medic_specialty' => $medic_specialty,
                'specialty' => $specialty
            ];
            return self::view('medic/edit', $data);
        } else {
            redirect('/');
        }
    }

    /**
     * Cadastra um novo médico no banco de dados
     */
    public function save()
    {
        $data = Router::getRequest();
        try {
            $MedicModel = new MedicModel();
            $validation = false;

            if (count($data['specialty']) < 2) {
                $validation = true;
                setError('Preencha no minímo duas Especialidades !!');
            }

            if (!$validation) {
                $data['phone'] = onlyNumbers($data['phone']);

                if ($MedicModel->save($data) > 0) {
                    setSuccess('Médico Cadastrado!!');
                } else {
                    setError('Ocorreu um erro tente novamente!');
                }
            }
        } catch (Exception $e) {
            setError('Ocorreu um erro tente novamente!');
        }
        redirect('/create_medic');
    }

    /**
     * Cadastra um novo médico no banco de dados
     */
    public function update()
    {
        $data = Router::getRequest();
        if ($data['id']) {
            try {
                $MedicModel = new MedicModel();
                $validation = false;

                if (count($data['specialty']) < 2) {
                    $validation = true;
                    setError('Preencha no minímo duas Especialidades !!');
                }

                if (!$validation) {
                    $data['phone'] = onlyNumbers($data['phone']);

                    if ($MedicModel->edit($data)) {
                        setSuccess('Médico Editado!!');
                    } else {
                        setError('Ocorreu um erro tente novamente!');
                    }
                }
            } catch (Exception $e) {
                setError('Ocorreu um erro tente novamente!');
            }
            redirect('/edit_medic&i='.strrev(base64_encode($data['id'])));
        } else {
            redirect('/');
        }
    }

    /**
     * Deleta um médico do banco de dados
     */
    public function delete()
    {
        $data = Router::getRequest();
        $id = base64_decode(strrev($data['i']));
        try {
            $MedicModel = new MedicModel();

            if ($MedicModel->destroy($id)) {
                setSuccess('Médico Deletado!!');
            } else {
                setError('Ocorreu um erro tente novamente!');
            }
        } catch (Exception $e) {
            setError('Ocorreu um erro tente novamente!');
        }
        redirect('/');
    }
}