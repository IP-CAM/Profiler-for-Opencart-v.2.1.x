<?php
class ControllerModulePvnmProfiler extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/pvnm_profiler');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pvnm_profiler', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_email'] = $this->language->get('tab_email');
		$data['tab_help'] = $this->language->get('tab_help');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_developer'] = $this->language->get('text_developer');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_catalog'] = $this->language->get('text_catalog');
		$data['text_slow'] = $this->language->get('text_slow');
		$data['text_email_url'] = $this->language->get('text_email_url');
		$data['text_email_date'] = $this->language->get('text_email_date');
		$data['text_email_time'] = $this->language->get('text_email_time');
		$data['text_email_queries'] = $this->language->get('text_email_queries');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_body_status'] = $this->language->get('entry_body_status');
		$data['entry_console_status'] = $this->language->get('entry_console_status');
		$data['entry_query_time'] = $this->language->get('entry_query_time');
		$data['entry_page_time'] = $this->language->get('entry_page_time');
		$data['entry_page_write'] = $this->language->get('entry_page_write');
		$data['entry_page_email'] = $this->language->get('entry_page_email');
		$data['entry_macros'] = $this->language->get('entry_macros');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pvnm_profiler_status'])) {
			$data['pvnm_profiler_status'] = $this->request->post['pvnm_profiler_status'];
		} else {
			$data['pvnm_profiler_status'] = $this->config->get('pvnm_profiler_status');
		}

		if (isset($this->request->post['pvnm_profiler_body_status'])) {
			$data['pvnm_profiler_body_status'] = $this->request->post['pvnm_profiler_body_status'];
		} else {
			$data['pvnm_profiler_body_status'] = $this->config->get('pvnm_profiler_body_status');
		}

		if (isset($this->request->post['pvnm_profiler_console_status'])) {
			$data['pvnm_profiler_console_status'] = $this->request->post['pvnm_profiler_console_status'];
		} else {
			$data['pvnm_profiler_console_status'] = $this->config->get('pvnm_profiler_console_status');
		}

		if (isset($this->request->post['pvnm_profiler_query_time'])) {
			$data['pvnm_profiler_query_time'] = $this->request->post['pvnm_profiler_query_time'];
		} else {
			$data['pvnm_profiler_query_time'] = $this->config->get('pvnm_profiler_query_time');
		}

		if (isset($this->request->post['pvnm_profiler_page_time'])) {
			$data['pvnm_profiler_page_time'] = $this->request->post['pvnm_profiler_page_time'];
		} else {
			$data['pvnm_profiler_page_time'] = $this->config->get('pvnm_profiler_page_time');
		}

		if (isset($this->request->post['pvnm_profiler_page_write'])) {
			$data['pvnm_profiler_page_write'] = $this->request->post['pvnm_profiler_page_write'];
		} else {
			$data['pvnm_profiler_page_write'] = $this->config->get('pvnm_profiler_page_write');
		}

		if (isset($this->request->post['pvnm_profiler_page_email'])) {
			$data['pvnm_profiler_page_email'] = $this->request->post['pvnm_profiler_page_email'];
		} else {
			$data['pvnm_profiler_page_email'] = $this->config->get('pvnm_profiler_page_email');
		}

		if (isset($this->request->post['pvnm_profiler_email_subject'])) {
			$data['pvnm_profiler_email_subject'] = $this->request->post['pvnm_profiler_email_subject'];
		} elseif ($this->config->get('pvnm_profiler_email_subject')) {
			$data['pvnm_profiler_email_subject'] = $this->config->get('pvnm_profiler_email_subject');
		} else {
			$data['pvnm_profiler_email_subject'] = array();
		}

		if (isset($this->request->post['pvnm_profiler_email_message'])) {
			$data['pvnm_profiler_email_message'] = $this->request->post['pvnm_profiler_email_message'];
		} elseif ($this->config->get('pvnm_profiler_email_message')) {
			$data['pvnm_profiler_email_message'] = $this->config->get('pvnm_profiler_email_message');
		} else {
			$data['pvnm_profiler_email_message'] = array();
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_profiler.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/pvnm_profiler')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('module/pvnm_profiler');

		$this->model_module_pvnm_profiler->install();
	}

	public function uninstall() {
		$this->load->model('module/pvnm_profiler');

		$this->model_module_pvnm_profiler->uninstall();
	}
}