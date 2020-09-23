<?php
class ControllerExtensionModuleTmdsocialLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/tmdsociallogin');

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/module');

	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('tmdsociallogin', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_facbook'] = $this->language->get('tab_facbook');
		$data['tab_twitter'] = $this->language->get('tab_twitter');
		$data['tab_google'] = $this->language->get('tab_google');
		$data['tab_linkedin'] = $this->language->get('tab_linkedin');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_apikey'] = $this->language->get('entry_apikey');
		$data['entry_apisecret'] = $this->language->get('entry_apisecret');
		$data['entry_twapikey'] = $this->language->get('entry_twapikey');
		$data['entry_twapisecret'] = $this->language->get('entry_twapisecret');
		$data['entry_goapikey'] = $this->language->get('entry_goapikey');
		$data['entry_goapisecret'] = $this->language->get('entry_goapisecret');
		$data['entry_liapikey'] = $this->language->get('entry_liapikey');
		$data['entry_liapisecret'] = $this->language->get('entry_liapisecret');
		$data['entry_iconsize'] = $this->language->get('entry_iconsize');
		$data['text_fblink'] = $this->language->get('text_fblink');
		$data['text_twitlink'] = $this->language->get('text_twitlink');
		$data['text_gogllink'] = $this->language->get('text_gogllink');
		$data['text_linkdinlink'] = $this->language->get('text_linkdinlink');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['fbapikey'])) {
			$data['error_fbapikey'] = $this->error['fbapikey'];
		} else {
			$data['error_fbapikey'] = '';
		}
		
		if (isset($this->error['fbsecretapi'])) {
			$data['error_fbsecretapi'] = $this->error['fbsecretapi'];
		} else {
			$data['error_fbsecretapi'] = '';
		}
		
		if (isset($this->error['twitapikey'])) {
			$data['error_twitapikey'] = $this->error['twitapikey'];
		} else {
			$data['error_twitapikey'] = '';
		}
		
		
		if (isset($this->error['twitsecretapi'])) {
			$data['error_twitsecret'] = $this->error['twitsecretapi'];
		} else {
			$data['error_twitsecret'] = '';
		}
		
	
		if (isset($this->error['gogleapikey'])) {
			$data['error_gogleapikey'] = $this->error['gogleapikey'];
		} else {
			$data['error_gogleapikey'] = '';
		}
		
		if (isset($this->error['gogelsecretapi'])) {
			$data['error_goglesecret'] = $this->error['gogelsecretapi'];
		} else {
			$data['error_goglesecret'] = '';
		}
		
		if (isset($this->error['linkdinapikey'])) {
			$data['error_linkdinapikey'] = $this->error['linkdinapikey'];
		} else {
			$data['error_linkdinapikey'] = '';
		}
		
		if (isset($this->error['linkdinsecretapi'])) {
			$data['error_linkdinsecret'] = $this->error['linkdinsecretapi'];
		} else {
			$data['error_linkdinsecret'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/tmdsociallogin', 'user_token=' . $this->session->data['user_token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/tmdsociallogin', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/tmdsociallogin', 'user_token=' . $this->session->data['user_token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/module/tmdsociallogin', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
						
		
		if (isset($this->request->post['fbtitle'])) {
			$data['fbtitle'] = $this->request->post['fbtitle'];
		} elseif (!empty($module_info)) {
			$data['fbtitle'] = $module_info['fbtitle'];
		} else {
			$data['fbtitle'] = '';
		}
			
		if (isset($this->request->post['twittertitle'])) {
			$data['twittertitle'] = $this->request->post['twittertitle'];
		} elseif (!empty($module_info)) {
			$data['twittertitle'] = $module_info['twittertitle'];
		} else {
			$data['twittertitle'] = '';
		}
				
		if (isset($this->request->post['googletitle'])) {
			$data['googletitle'] = $this->request->post['googletitle'];
		} elseif (!empty($module_info)) {
			$data['googletitle'] = $module_info['googletitle'];
		} else {
			$data['googletitle'] = '';
		}
					
		if (isset($this->request->post['linkedintitle'])) {
			$data['linkedintitle'] = $this->request->post['linkedintitle'];
		} elseif (!empty($module_info)) {
			$data['linkedintitle'] = $module_info['linkedintitle'];
		} else {
			$data['linkedintitle'] = '';
		}
						
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = '100';
		}
		
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = '100';
		}
			
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = 0;
		}
					
					
		
		if (isset($this->request->post['fbstatus'])) {
			$data['fbstatus'] = $this->request->post['fbstatus'];
		} elseif (!empty($module_info)) {
			$data['fbstatus'] = $module_info['fbstatus'];
		} else {
			$data['fbstatus'] = '';
		}
		
		if (isset($this->request->post['twitstatus'])) {
			$data['twitstatus'] = $this->request->post['twitstatus'];
		} elseif (!empty($module_info)) {
			$data['twitstatus'] = $module_info['twitstatus'];
		} else {
			$data['twitstatus'] = '';
		}
		
		if (isset($this->request->post['goglestatus'])) {
			$data['goglestatus'] = $this->request->post['goglestatus'];
		} elseif (!empty($module_info)) {
			$data['goglestatus'] = $module_info['goglestatus'];
		} else {
			$data['goglestatus'] = '';
		}
		
		if (isset($this->request->post['linkstatus'])) {
			$data['linkstatus'] = $this->request->post['linkstatus'];
		} elseif (!empty($module_info)) {
			$data['linkstatus'] = $module_info['linkstatus'];
		} else {
			$data['linkstatus'] = '';
		}
		
		if (isset($this->request->post['fbimage'])) {
			$data['fbimage'] = $this->request->post['fbimage'];
		} elseif (!empty($module_info)) {
			$data['fbimage'] = $module_info['fbimage'];
		} else {
			$data['fbimage'] = '';
		}
		
			
		if (isset($this->request->post['twitimage'])) {
			$data['twitimage'] = $this->request->post['twitimage'];
		} elseif (!empty($module_info)) {
			$data['twitimage'] = $module_info['twitimage'];
		} else {
			$data['twitimage'] = '';
		}
		
		
		if (isset($this->request->post['gogleimage'])) {
			$data['gogleimage'] = $this->request->post['gogleimage'];
		} elseif (!empty($module_info)) {
			$data['gogleimage'] = $module_info['gogleimage'];
		} else {
			$data['gogleimage'] = '';
		}
	
		if (isset($this->request->post['linkdinimage'])) {
			$data['linkdinimage'] = $this->request->post['linkdinimage'];
		} elseif (!empty($module_info)) {
			$data['linkdinimage'] = $module_info['linkdinimage'];
		} else {
			$data['linkdinimage'] = '';
		}
		
		if (isset($this->request->post['fbapikey'])) {
			$data['fbapikey'] = $this->request->post['fbapikey'];
		} elseif (!empty($module_info)) {
			$data['fbapikey'] = $module_info['fbapikey'];
		} else {
			$data['fbapikey'] = '';
		}
		
		if (isset($this->request->post['fbsecretapi'])) {
			$data['fbsecretapi'] = $this->request->post['fbsecretapi'];
		} elseif (!empty($module_info)) {
			$data['fbsecretapi'] = $module_info['fbsecretapi'];
		} else {
			$data['fbsecretapi'] = '';
		}
		
		if (isset($this->request->post['twitapikey'])) {
			$data['twitapikey'] = $this->request->post['twitapikey'];
		} elseif (!empty($module_info)) {
			$data['twitapikey'] = $module_info['twitapikey'];
		} else {
			$data['twitapikey'] = '';
		}
		
		if (isset($this->request->post['twitsecretapi'])) {
			$data['twitsecretapi'] = $this->request->post['twitsecretapi'];
		} elseif (!empty($module_info)) {
			$data['twitsecretapi'] = $module_info['twitsecretapi'];
		} else {
			$data['twitsecretapi'] = '';
		}
		
		if (isset($this->request->post['gogleapikey'])) {
			$data['gogleapikey'] = $this->request->post['gogleapikey'];
		} elseif (!empty($module_info)) {
			$data['gogleapikey'] = $module_info['gogleapikey'];
		} else {
			$data['gogleapikey'] = '';
		}
		
		if (isset($this->request->post['gogelsecretapi'])) {
			$data['gogelsecretapi'] = $this->request->post['gogelsecretapi'];
		} elseif (!empty($module_info)) {
			$data['gogelsecretapi'] = $module_info['gogelsecretapi'];
		} else {
			$data['gogelsecretapi'] = '';
		}
		if (isset($this->request->post['linkdinapikey'])) {
			$data['linkdinapikey'] = $this->request->post['linkdinapikey'];
		} elseif (!empty($module_info)) {
			$data['linkdinapikey'] = $module_info['linkdinapikey'];
		} else {
			$data['linkdinapikey'] = '';
		}
		
		if (isset($this->request->post['linkdinsecretapi'])) {
			$data['linkdinsecretapi'] = $this->request->post['linkdinsecretapi'];
		} elseif (!empty($module_info)) {
			$data['linkdinsecretapi'] = $module_info['linkdinsecretapi'];
		} else {
			$data['linkdinsecretapi'] = '';
		}
		
		
		$this->load->model('tool/image');

		if (isset($this->request->post['fbimage']) && is_file(DIR_IMAGE . $this->request->post['fbimage'])) {
			$data['fbthumb'] = $this->model_tool_image->resize($this->request->post['fbimage'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['fbimage'])) {
			$data['fbthumb'] = $this->model_tool_image->resize($module_info['fbimage'], 100, 100);
		} else {
			$data['fbthumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['twitimage']) && is_file(DIR_IMAGE . $this->request->post['twitimage'])) {
			$data['twiterthumb'] = $this->model_tool_image->resize($this->request->post['twitimage'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['twitimage'])) {
			$data['twiterthumb'] = $this->model_tool_image->resize($module_info['twitimage'], 100, 100);
		} else {
			$data['twiterthumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['gogleimage']) && is_file(DIR_IMAGE . $this->request->post['gogleimage'])) {
			$data['goglethumb'] = $this->model_tool_image->resize($this->request->post['gogleimage'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['gogleimage'])) {
			$data['goglethumb'] = $this->model_tool_image->resize($module_info['gogleimage'], 100, 100);
		} else {
			$data['goglethumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}


		if (isset($this->request->post['linkdinimage']) && is_file(DIR_IMAGE . $this->request->post['linkdinimage'])) {
			$data['linkdinthumb'] = $this->model_tool_image->resize($this->request->post['linkdinimage'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['linkdinimage'])) {
			$data['linkdinthumb'] = $this->model_tool_image->resize($module_info['linkdinimage'], 100, 100);
		} else {
			$data['linkdinthumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/tmdsociallogin', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/tmdsociallogin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if(!empty($this->request->post['fbstatus']) && $this->request->post['fbstatus']==1) {
			
			if(empty($this->request->post['fbapikey'])) {
				$this->error['fbapikey'] = $this->language->get('error_fbapikey');
			}
				
			if(empty($this->request->post['fbsecretapi'])) {
				$this->error['fbsecretapi'] = $this->language->get('error_fbsecretapi');
			}
		
		}
		if(!empty($this->request->post['twitstatus']) && $this->request->post['twitstatus']==1) {
			if(empty($this->request->post['twitapikey'])) {
				$this->error['twitapikey'] = $this->language->get('error_twitapikey');
			}
			
			if(empty($this->request->post['twitsecretapi'])) {
				$this->error['twitsecretapi'] = $this->language->get('error_twitsecret');
			}
		}
		if(!empty($this->request->post['goglestatus']) && $this->request->post['goglestatus']==1) {
			if(empty($this->request->post['gogleapikey'])) {
				$this->error['gogleapikey'] = $this->language->get('error_gogleapikey');
			}
			if(empty($this->request->post['gogelsecretapi'])) {
				$this->error['gogelsecretapi'] = $this->language->get('error_goglesecret');
			}
		}
		
		if(!empty($this->request->post['linkstatus']) && $this->request->post['linkstatus']==1) {
		if(empty($this->request->post['linkdinapikey'])) {
			$this->error['linkdinapikey'] = $this->language->get('error_linkdinapikey');
		}
		
		if(empty($this->request->post['linkdinsecretapi'])) {
			$this->error['linkdinsecretapi'] = $this->language->get('error_linkdinsecret');
		}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
	

		return !$this->error;
	}
}