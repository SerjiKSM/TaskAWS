<?php

class Task
{
	private $task;
	private $date;
	private $tasks;
	
	public function saveTask()
	{
		try {
			$data = $this->getTasks();
			foreach ($data as $elem) {
				$task = htmlspecialchars(strip_tags($elem['task']));
				$date = htmlspecialchars(strip_tags(implode(" ", array($elem["date"], $elem["time"]))));
				$sql[] = "('$task', '$date')";
			}
			$query = 'INSERT INTO tasks (task, date) VALUES ' . implode(', ', $sql);
			$db = new Db();
			$dbConnection = $db->getConnection();
			$dbConnection->beginTransaction();
			$result = $dbConnection->prepare($query)->execute();
			$dbConnection->commit();
			
			return $result;
			
		} catch (Exception $e) {
			$dbConnection->rollBack();
			echo ' <h1 class="ErrorException">Error: </h1> ' . $e->getMessage();
		}
	}
	
	public function uploadFile()
	{
		try {
			if (empty($_FILES['file']['tmp_name']) || empty($_FILES['file']['name'])) {
				throw new Exception('<h1 class="ErrorException">Choose file!</h1>');
			}
			
			$fileStream = file_get_contents($_FILES['file']['tmp_name']);
			
			if (!is_uploaded_file($_FILES['file']['tmp_name']) || empty($fileStream) || $_FILES['file']['error'] > 0) {
				throw new Exception('<h1 class="ErrorException">Problem with file!</h1>');
			}
			
			$file_ext = explode('.', $_FILES['file']['name']);
			$file_ext = strtolower(end($file_ext));
			$allowedType = array('txt');
			
			if (!in_array($file_ext, $allowedType)) {
				throw new Exception('<h1 class="ErrorException">Problem with type of the file!</h1>');
			}
			
			$task = array();
			$fileData = explode(';', $fileStream);
			$pattern = "#[A-Za-z]+ [a-z]*[,]{1}[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}[,]{1}[0-9]{2}[:]{1}[0-9]{2}#";
			$countStr = 1;
			foreach ($fileData as $str) {
				$strData = explode(',', $str);
				$comma_separated = implode(",", $strData);
				if (preg_match($pattern, $comma_separated)) {
					$task['task'] = trim(htmlspecialchars(strip_tags($strData[0])));
					$task['date'] = trim(htmlspecialchars(strip_tags($strData[1])));
					$task['time'] = trim(htmlspecialchars(strip_tags($strData[2])));
					
					$tasks[] = $task;
				} else {
					if (!empty(trim($comma_separated))) {
						throw new Exception(' Invalid string format In file string № ' . $countStr . ' is mistake (for correct work with file, need next format of the string - Example: Prepare dinner,2017-01-03,12:15;  ) - ' . htmlspecialchars($comma_separated));
					}
				}
				
				$countStr++;
			}
			
			$this->setTasks($tasks);
			
		} catch (Exception $e) {
			echo ' <h1 class="ErrorException">Error: </h1>', $e->getMessage(), "\n";
			
			return false;
		} finally {
//			if (!empty($fileStream)){
//				fclose($fileStream);
//			}
		}
		
		return true;
		
	}
	
	public function debug($param, $die = true)
	{
		echo '<pre>';
		var_dump($param);
		echo '</pre>';
		if ($die) {
			die();
		}
		
	}
	
	public function getDataTasks()
	{
		$db = new Db();
		$dbConnection = $db->getConnection();
		
		$sql = 'SELECT `id`, `task`, `date`, `done`, `id_user` FROM `tasks`	WHERE `id_user` = 0 GROUP BY `id`';
		$result = $dbConnection->prepare($sql);
		$result->execute();
		$data = $result->fetchAll();
		
		if ($data) {
			return $data;
		}
		
		return false;
	}
	
	public function setTasks($tasks)
	{
		$this->tasks = $tasks;
	}
	
	public function getTasks()
	{
		return $this->tasks;
	}
	
	/**
	 * @param mixed $task
	 */
	public function setTask($task)
	{
		$this->task = $task;
	}
	
	/**
	 * @param mixed $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}
	
	/**
	 * @return mixed
	 */
	public function getTask()
	{
		return $this->task;
	}
	
	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	private function parsExecutor()
	{
		$postData[] = $_POST['executors'];
		$arrDataId = '';
		$i = 0;
		if (!empty($postData)) {
			foreach ($postData[0] as $data) {
				$strData = htmlspecialchars($data);
				$arrData = explode('-', $strData);
				if (!empty($arrData[0]) && !empty($arrData[1])) {
					$arrTask = explode('_', $arrData[0]);
					$arrUser = explode('_', $arrData[1]);
					$taskId = $arrTask[1];
					$userId = $arrUser[1];
					$arrDataId[$i]['taskId'] = $taskId;
					$arrDataId[$i]['userId'] = $userId;
					$i++;
				}
			}
		}
		return $arrDataId;
	}
	
	public function addExecuter()
	{
		try {
			$arrId[] = $this->parsExecutor();
			if (empty($arrId[0]) && empty($arrId[1])) {
				return false;
			}
			foreach ($arrId as $items) {
				foreach ($items as $id) {
					$taskId = intval($id['taskId']);
					$userId = intval($id['userId']);
					$sql[] = "('$taskId', '$userId')";
				}
			}
			
			$query = 'INSERT INTO `tasks` (`id`,`id_user`) VALUES ' . implode(', ', $sql) . ' ON DUPLICATE KEY UPDATE `id_user` = VALUES(`id_user`)';
			
			$db = new Db();
			$dbConnection = $db->getConnection();
			$dbConnection->beginTransaction();
			$result = $dbConnection->prepare($query)->execute();
			$dbConnection->commit();
			
			return $result;
			
		} catch (Exception $e) {
			$dbConnection->rollBack();
			echo ' <h1 class="ErrorException">Error: </h1> ' . $e->getMessage();
		}
		
	}
	
	public function getUserTasks()
	{
		$id = intval($_SESSION['logged_user_id']);
		if ($id) {
			$db = new Db();
			$dbConnection = $db->getConnection();
			
			$sql = 'SELECT tableTasks.id, tableTasks.task, tableTasks.date, tableTasks.done, tableTasks.id_user,tableUsers.name FROM `tasks` AS tableTasks LEFT JOIN users as tableUsers ON tableTasks.id_user = tableUsers.id WHERE tableTasks.id_user = :id';
			$result = $dbConnection->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();
			$data = $result->fetchAll();
			
			if ($data) {
				return $data;
			}
			
			return false;
		}
	}
	
	public function saveDone()
	{
		if(!empty($_POST['done'])){
			$postDataDone = $_POST['done'];
			$sql = '';
			foreach ($postDataDone as $key => $value) {
				$id = intval($value);
				$sql .= $id .',';
			}
			$sql = substr($sql, 0, -1);
			try {
				$query = 'UPDATE `tasks` SET `done` = 1 WHERE `id` IN ('.$sql.')';
				$db = new Db();
				$dbConnection = $db->getConnection();
				$dbConnection->beginTransaction();
				$result = $dbConnection->prepare($query)->execute();
				$dbConnection->commit();
				return $result;

			}catch (Exception $e) {
				$dbConnection->rollBack();
				echo ' <h1 class="ErrorException">Error: </h1> ' . $e->getMessage();
			}
						
		}else{
			echo ' <h1 class="ErrorException">Error: Choose and check column done! </h1> ';
		}
		
	}
	
	public function getAllTask()
	{
		$db = new Db();
		$dbConnection = $db->getConnection();
		
		$sql = 'SELECT tableTasks.id, tableTasks.task, tableTasks.date, tableTasks.done, tableTasks.id_user,tableUsers.name FROM `tasks` AS tableTasks LEFT JOIN users as tableUsers ON tableTasks.id_user = tableUsers.id ';
		$result = $dbConnection->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		$data = $result->fetchAll();
		
		if ($data) {
			return $data;
		}
		
		return false;
	}
}