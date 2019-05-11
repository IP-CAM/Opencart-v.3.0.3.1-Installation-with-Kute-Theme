<?php
class ControllerModulePopularCategory extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/popular_category');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('popular_category', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_category_1'] = $this->language->get('entry_category_1');
		$data['entry_category_2'] = $this->language->get('entry_category_2');
		$data['entry_category_3'] = $this->language->get('entry_category_3');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/popular_category', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/popular_category', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/popular_category', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/popular_category', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['token'] = $this->session->data['token'];

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['category_1st_id'])) {
            $data['category_1st_id'] = $this->request->post['category_1st_id'];
        } elseif (!empty($module_info)) {
            $data['category_1st_id'] = $module_info['category_1st_id'];
        } else {
            $data['category_1st_id'] = '';
        }

        if (isset($this->request->post['category_1st_name'])) {
            $data['category_1st_name'] = $this->request->post['category_1st_name'];
        } elseif (!empty($module_info)) {
            $data['category_1st_name'] = $module_info['category_1st_name'];
        } else {
            $data['category_1st_name'] = '';
        }

        if (isset($this->request->post['category_2nd_id'])) {
            $data['category_2nd_id'] = $this->request->post['category_2nd_id'];
        } elseif (!empty($module_info)) {
            $data['category_2nd_id'] = $module_info['category_2nd_id'];
        } else {
            $data['category_2nd_id'] = '';
        }

        if (isset($this->request->post['category_2nd_name'])) {
            $data['category_2nd_name'] = $this->request->post['category_2nd_name'];
        } elseif (!empty($module_info)) {
            $data['category_2nd_name'] = $module_info['category_2nd_name'];
        } else {
            $data['category_2nd_name'] = '';
        }

        if (isset($this->request->post['category_3rd_id'])) {
            $data['category_3rd_id'] = $this->request->post['category_3rd_id'];
        } elseif (!empty($module_info)) {
            $data['category_3rd_id'] = $module_info['category_3rd_id'];
        } else {
            $data['category_3rd_id'] = '';
        }

        if (isset($this->request->post['category_3rd_name'])) {
            $data['category_3rd_name'] = $this->request->post['category_3rd_name'];
        } elseif (!empty($module_info)) {
            $data['category_3rd_name'] = $module_info['category_3rd_name'];
        } else {
            $data['category_3rd_name'] = '';
        }

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/popular_category.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/popular_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
}