CREATE TABLE Calendar (id BIGINT AUTO_INCREMENT, beginn DATETIME NOT NULL, duration BIGINT NOT NULL, job_id BIGINT, type_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX job_id_idx (job_id), INDEX type_id_idx (type_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE CalendarType (id BIGINT AUTO_INCREMENT, name TEXT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE calendar_user (calendar_id BIGINT, user_id BIGINT, PRIMARY KEY(calendar_id, user_id)) ENGINE = INNODB;
CREATE TABLE customer (id BIGINT AUTO_INCREMENT, company VARCHAR(255) NOT NULL, logo VARCHAR(255), url VARCHAR(255), number BIGINT UNIQUE NOT NULL, headoffice BIGINT NOT NULL, INDEX headoffice_idx (headoffice), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE Entry (id BIGINT AUTO_INCREMENT, description VARCHAR(255), amount BIGINT NOT NULL, item_id BIGINT, job_id BIGINT, INDEX job_id_idx (job_id), INDEX item_id_idx (item_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE file (id BIGINT AUTO_INCREMENT, name VARCHAR(64) NOT NULL, file VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE file_job (file_id BIGINT, job_id BIGINT, PRIMARY KEY(file_id, job_id)) ENGINE = INNODB;
CREATE TABLE holiday (id BIGINT AUTO_INCREMENT, name TEXT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE invoice (id BIGINT AUTO_INCREMENT, number BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE item (id BIGINT AUTO_INCREMENT, code VARCHAR(10) NOT NULL, name VARCHAR(64) NOT NULL, unit VARCHAR(32) NOT NULL, description VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE itementry (id BIGINT AUTO_INCREMENT, amount BIGINT NOT NULL, item_id BIGINT, job_id BIGINT, INDEX job_id_idx (job_id), INDEX item_id_idx (item_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE itemtyp (id BIGINT AUTO_INCREMENT, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE job (id BIGINT AUTO_INCREMENT, contact_person VARCHAR(255), contact_info VARCHAR(255), job_type_id BIGINT NOT NULL, end DATETIME NOT NULL, start DATETIME, timeed DATETIME, description LONGTEXT, timeinterval TINYINT, job_state_id BIGINT NOT NULL, store_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX store_id_idx (store_id), INDEX job_state_id_idx (job_state_id), INDEX job_type_id_idx (job_type_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE jobchangelog (id BIGINT AUTO_INCREMENT, job_id BIGINT NOT NULL, user_id BIGINT NOT NULL, action TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE job_invoice (job_id BIGINT, invoice_id BIGINT, PRIMARY KEY(job_id, invoice_id)) ENGINE = INNODB;
CREATE TABLE job_state (id BIGINT AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE job_type (id BIGINT AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE job_user (job_id BIGINT, user_id BIGINT, PRIMARY KEY(job_id, user_id)) ENGINE = INNODB;
CREATE TABLE message (id BIGINT AUTO_INCREMENT, parent BIGINT, sender BIGINT NOT NULL, reciver BIGINT, job_id BIGINT, body LONGTEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX sender_idx (sender), INDEX job_id_idx (job_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE settings (id BIGINT AUTO_INCREMENT, name TEXT NOT NULL, value TEXT NOT NULL, type TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE store (id BIGINT AUTO_INCREMENT, number VARCHAR(8) NOT NULL, contact VARCHAR(255) NOT NULL, info LONGTEXT, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255), destrict VARCHAR(255), fon TEXT NOT NULL, fax TEXT, postcode BIGINT NOT NULL, customer_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX customer_id_idx (customer_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE task (id BIGINT AUTO_INCREMENT, start DATETIME, end DATETIME, scheduled TINYINT(1), break BIGINT, overtime BIGINT, info LONGTEXT, approach BIGINT, job_id BIGINT, task_type_id BIGINT DEFAULT 1, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX job_id_idx (job_id), INDEX task_type_id_idx (task_type_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE jobchangelog (id BIGINT AUTO_INCREMENT, task_id BIGINT NOT NULL, user_id BIGINT NOT NULL, action TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE taskposition (id BIGINT AUTO_INCREMENT, amount BIGINT NOT NULL, item_id BIGINT, INDEX item_id_idx (item_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE task_type (id BIGINT AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE task_user (task_id BIGINT, user_id BIGINT, PRIMARY KEY(task_id, user_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE Calendar ADD CONSTRAINT Calendar_type_id_CalendarType_id FOREIGN KEY (type_id) REFERENCES CalendarType(id);
ALTER TABLE Calendar ADD CONSTRAINT Calendar_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE calendar_user ADD CONSTRAINT calendar_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE calendar_user ADD CONSTRAINT calendar_user_calendar_id_Calendar_id FOREIGN KEY (calendar_id) REFERENCES Calendar(id);
ALTER TABLE customer ADD CONSTRAINT customer_headoffice_store_id FOREIGN KEY (headoffice) REFERENCES store(id);
ALTER TABLE Entry ADD CONSTRAINT Entry_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE Entry ADD CONSTRAINT Entry_item_id_item_id FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE file_job ADD CONSTRAINT file_job_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE file_job ADD CONSTRAINT file_job_file_id_file_id FOREIGN KEY (file_id) REFERENCES file(id);
ALTER TABLE itementry ADD CONSTRAINT itementry_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE itementry ADD CONSTRAINT itementry_item_id_item_id FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE job ADD CONSTRAINT job_store_id_store_id FOREIGN KEY (store_id) REFERENCES store(id);
ALTER TABLE job ADD CONSTRAINT job_job_type_id_job_type_id FOREIGN KEY (job_type_id) REFERENCES job_type(id);
ALTER TABLE job ADD CONSTRAINT job_job_state_id_job_state_id FOREIGN KEY (job_state_id) REFERENCES job_state(id);
ALTER TABLE job_invoice ADD CONSTRAINT job_invoice_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE job_invoice ADD CONSTRAINT job_invoice_invoice_id_invoice_id FOREIGN KEY (invoice_id) REFERENCES invoice(id);
ALTER TABLE job_user ADD CONSTRAINT job_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE message ADD CONSTRAINT message_sender_sf_guard_user_id FOREIGN KEY (sender) REFERENCES sf_guard_user(id);
ALTER TABLE message ADD CONSTRAINT message_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE store ADD CONSTRAINT store_customer_id_customer_id FOREIGN KEY (customer_id) REFERENCES customer(id);
ALTER TABLE task ADD CONSTRAINT task_task_type_id_task_type_id FOREIGN KEY (task_type_id) REFERENCES task_type(id);
ALTER TABLE task ADD CONSTRAINT task_job_id_job_id FOREIGN KEY (job_id) REFERENCES job(id);
ALTER TABLE taskposition ADD CONSTRAINT taskposition_item_id_item_id FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE task_user ADD CONSTRAINT task_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE task_user ADD CONSTRAINT task_user_task_id_task_id FOREIGN KEY (task_id) REFERENCES task(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
