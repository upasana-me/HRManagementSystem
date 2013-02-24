<?php

$showTables = "SHOW TABLES LIKE 'EMPLOYEE'";

$retrieveID_access = "SELECT Access, ID FROM USERS WHERE Username='";
$retrieveInfo = "SELECT Username, Password FROM USERS WHERE ID='";

$retrieveFname = "SELECT Fname FROM EMPLOYEE WHERE EmployeeID='";
$retrieveName = "SELECT Fname, Mname, Lname FROM EMPLOYEE WHERE EmployeeID='";
$retrieveDOB = "SELECT DOB FROM EMPLOYEE WHERE EmployeeID='";
$retrieveGender = "SELECT Gender FROM EMPLOYEE WHERE EmployeeID='";
$retrieveResAddress = "SELECT ResAddress FROM EMPLOYEE WHERE EmployeeID='";
$retrievePermAddress = "SELECT PermAddress FROM EMPLOYEE WHERE EmployeeID='";
$retrieveConNumber = "SELECT MobileNumber FROM EMPLOYEE WHERE EmployeeID='";
$retrieveEmail = "SELECT Email FROM EMPLOYEE WHERE EmployeeID='";
$retrieveMStatus = "SELECT MStatus FROM EMPLOYEE WHERE EmployeeID='";
$retrieveSalary = "SELECT Salary FROM EMPLOYEE WHERE EmployeeID='";
$retrieveLeaves = "SELECT Leaves FROM EMPLOYEE WHERE EmployeeID='";
$retrievePromotions = "SELECT Promotions FROM EMPLOYEE WHERE EmployeeID='";
$retrieveHireDate = "SELECT HireDate FROM EMPLOYEE WHERE EmployeeID='";
$retrieveAllLangW = "SELECT LangID FROM LANGKNOWNW WHERE EmployeeID='";
$retrieveAllLangS = "SELECT LangID FROM LANGKNOWNS WHERE EmployeeID='";
$retrieveAllDegreeByID = "SELECT * FROM DEGREES WHERE EmployeeID='";
$retrievePassport = "SELECT Passport FROM EMPLOYEE WHERE EmployeeID='";
$retrieveDrivingLicense = "SELECT DrivingLicense FROM EMPLOYEE WHERE EmployeeID='";
$retrieveAchsByID = "SELECT * FROM ACHIEVEMENTS WHERE EmployeeID='";
$retrieveOfficeID = "SELECT OfficeID FROM EMPLOYEE WHERE EmployeeID='";

$retrieveEmpIDNames = "SELECT Fname, Mname, Lname, EmployeeID FROM EMPLOYEE";

$retrieveEmpID = "SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID='";

$retrieveQual = "SELECT QualDesc FROM QUALIFICATION, EMPLOYEE WHERE QUALIFICATION.QualID=(SELECT EMPLOYEE.QualID FROM EMPLOYEE WHERE EmployeeID='";
$retrieveDept = "SELECT DeptName FROM DEPARTMENT, EMPLOYEE WHERE DEPARTMENT.DeptID=(SELECT EMPLOYEE.DeptID FROM EMPLOYEE WHERE EmployeeID='";
$retrievePos = "SELECT PosDesc FROM POSITIONS, EMPLOYEE WHERE POSITIONS.PositionID=(SELECT EMPLOYEE.PositionID FROM EMPLOYEE WHERE EmployeeID='";
$retrieveSupervisor = "SELECTc Fname, Mname, Lname FROM EMPLOYEE E1 WHERE E1.EmployeeID=(SELECT E2.SupervisorID FROM EMPLOYEE E2 WHERE E2.EmployeeID='";
$retrieveSupervisorID = "SELECT SupervisorID FROM EMPLOYEE WHERE EmployeeID='";

$retrieveDependents = "SELECT * FROM DEPENDENTS WHERE EmployeeID='";

$retrieveUnReadMsgCount = "SELECT COUNT(ReadOrNot) FROM EMPMESSAGES WHERE ReadOrNot=0";
$retrieveMessages = "SELECT * FROM EMPMESSAGES";
$retrieveMsgCount = "SELECT COUNT(MessageID) FROM EMPMESSAGES"; 

$retrieveCompName = "SELECT CompanyName FROM COMPANY";
$deleteCompName = "DELETE FROM COMPANY";
$insertCompName = "INSERT INTO COMPANY VALUES('";

$retrieveAllDept = "SELECT * FROM DEPARTMENT";
$retrieveDeptID = "SELECT DeptID FROM DEPARTMENT WHERE DeptID='";
$deleteDept = "DELETE FROM DEPARTMENT WHERE DeptID='";
$retrieveDeptLocID = "SELECT DeptID, Location FROM DEPARTMENT WHERE DeptID='";
$retrieveDeptLocName = "SELECT DeptName, Location FROM DEPARTMENT WHERE DeptName='";
$retrieveDeptName = "SELECT DeptName FROM DEPARTMENT";
$retrieveDeptIDByName = "SELECT DeptID FROM DEPARTMENT WHERE DeptName='";
$retrieveDeptNameByID = "SELECT DeptName FROM DEPARTMENT WHERE DeptID='";

$retrieveAllPos = "SELECT * FROM POSITIONS";
$retrievePosID = "SELECT PositionID FROM POSITIONS WHERE PositionID='";
$deletePos = "DELETE FROM POSITIONS WHERE PositionID='";
$retrievePosDesc = "SELECT PosDesc FROM POSITIONS";
$retrievePosIDByDesc = "SELECT PositionID FROM POSITIONS WHERE PosDesc='";

$retrieveAllQual = "SELECT * FROM QUALIFICATION";
$retrieveQualID = "SELECT QualID FROM QUALIFICATION WHERE QualID='";
$deleteQual = "DELETE FROM QUALIFICATION WHERE QualID='";
$retrieveQualDesc = "SELECT QualDesc FROM QUALIFICATION";
$retrieveQualIDByDesc = "SELECT QualID FROM QUALIFICATION WHERE QualDesc='";
$retrieveQualDescByID = "SELECT QualDesc FROM QUALIFICATION WHERE QualID='";

$retrieveAllOff = "SELECT * FROM OFFICES";
$retrieveOffID = "SELECT OfficeID FROM OFFICES WHERE OfficeID='";
$deleteOffice = "DELETE FROM OFFICES WHERE OfficeID='";
$retrieveOffLocID = "SELECT OfficeID, Location FROM OFFICES WHERE OfficeID='";
$retrieveOffIDPhone = "SELECT OfficeID, PhoneNumber FROM OFFICES WHERE OfficeID='";
$retrieveOffIDFax = "SELECT OfficeID, Fax FROM OFFICES WHERE OfficeID='";
$retrieveOffIDLoc = "SELECT OfficeID, Location FROM OFFICES";
$retrieveOffIDByLoc = "SELECT OfficeID FROM OFFICES WHERE Location='";

$retrieveAllLang = "SELECT * FROM LANGUAGES";
$retrieveLangID = "SELECT LangID FROM LANGUAGES WHERE LangID='";
$deleteLang = "DELETE FROM LANGUAGES WHERE LangID='";
$retrieveLangName = "SELECT LangName FROM LANGUAGES";
$retrieveLangIDByName = "SELECT LangID FROM LANGUAGES WHERE LangName='";
$retrieveLangWID = "SELECT LangID FROM LANGKNOWNW WHERE EmployeeID='";
$retrieveLangSID = "SELECT LangID FROM LANGKNOWNS WHERE EmployeeID='";
$retrieveLangNameByID = "SELECT LangName FROM LANGUAGES WHERE LangID='";
$retrieveLangNameByName = "SELECT LangName FROM LANGUAGES WHERE LangName='";

$retrieveAllSkills = "SELECT * FROM SKILLS";
$retrieveSkillID = "SELECT SkillID FROM SKILLS WHERE SkillID='";
$deleteSkill = "DELETE FROM SKILLS WHERE SkillID='";
$retrieveSkillDesc = "SELECT SkillDesc FROM SKILLS";
$retrieveSkillIDByDesc = "SELECT SkillID FROM SKILLS WHERE SkillDesc='";

$retrieveSkillFromSkillSet = "SELECT SkillID FROM SKILLSET WHERE EmployeeID='";
$retrieveSkillDescByID = "SELECT SkillDesc FROM SKILLS WHERE SkillID='";

$retrieveQualIDDegree = "SELECT QualID FROM DEGREES WHERE EmployeeID='";

$retrieveMaxDepID = "SELECT MAX(DependentID) FROM DEPENDENTS WHERE EmployeeID='";
$retrieveMaxAchID = "SELECT MAX(AchievementID) FROM ACHIEVEMENTS WHERE EmployeeID='";
$retrieveMaxUsers = "SELECT MAX(ID) FROM USERS";
$retrieveMaxEmpID = "SELECT MAX(EmployeeID) FROM EMPLOYEE";

$retrieveAllEmpIDNames = "SELECT EmployeeID,Fname,Mname,Lname FROM EMPLOYEE";

$deleteEmpFromAchs = "DELETE FROM ACHIEVEMENTS WHERE EmployeeID='";
$deleteEmpFromSkillSet = "DELETE FROM SKILLSET WHERE EmployeeID='";
$deleteEmpFromDegrees = "DELETE FROM DEGREES WHERE EmployeeID='";
$deleteEmpFromDep = "DELETE FROM DEPENDENTS WHERE EmployeeID='";
$deleteEmpFromManagers = "DELETE FROM MANAGERS WHERE ManagerID='";
$deleteEmpFromLangKnownW = "DELETE FROM LANGKNOWNW WHERE EmployeeID='";
$deleteEmpFromLangKnownS = "DELETE FROM LANGKNOWNS WHERE EmployeeID='";
$deleteEmpFromEmpMessages = "DELETE FROM EMPMESSAGES WHERE ID='";
$deleteEmpFromEmployee = "DELETE FROM EMPLOYEE WHERE EmployeeID='";
$deleteEmpFromEmpSuper = "DELETE FROM EMPLOYEE WHERE SupervisorID='";
$deleteEmpFromUsers = "DELETE FROM USERS WHERE ID='";

$retrieveEmpByFirstName = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Fname='";
$retrieveEmpByLangKnownW = "SELECT EmployeeID FROM LANGKNOWNW WHERE LangID='";
$retrieveEmpByLangKnownS = "SELECT EmployeeID FROM LANGKNOWNS WHERE LangID='";
$retrieveEmpHavingPassport = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Passport='1'";
$retrieveEmpHavingDL = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE DrivingLicense='1'";
$retrieveEmpIDByQualID = "SELECT EmployeeID FROM DEGREES WHERE QualID='";
$retrieveEmpIDBySkillID = "SELECT EmployeeID FROM SKILLSET WHERE SkillID='";
$retrieveEmpByDeptID = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE DeptID='";
$retrieveEmpByPosID = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE PositionID='";
$retrieveEmpByOffID = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE OfficeID='";
$retrieveEmpBySalaryLt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Salary<'";
$retrieveEmpBySalaryEq = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Salary='";
$retrieveEmpBySalaryGt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Salary>'";
$retrieveEmpByLeavesLt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Leaves<'";
$retrieveEmpByLeavesEq = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Leaves='";
$retrieveEmpByLeavesGt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE Leaves>'";
$retrieveEmpByHireDateLt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE HireDate<'";
$retrieveEmpByHireDateEq = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE HireDate='";
$retrieveEmpByHireDateGt = "SELECT EmployeeID, Fname, Mname, Lname FROM EMPLOYEE WHERE HireDate>'";
$retrieveNameAndEmail = "SELECT Fname, Mname, Lname, Email FROM EMPLOYEE WHERE EmployeeID='";

$retrieveCompName = "SELECT CompanyName FROM COMPANY";

$retrieveDeptManaged = "SELECT DeptID FROM MANAGERS WHERE ManagerID='";

$retrieveAccessByID = "SELECT Access FROM USERS WHERE ID='";
$retrieveSkillIDFromSS = "SELECT SkillID FROM SKILLSET WHERE EmployeeID='";
$retrieveEmpMaxLeaves = "SELECT EmployeeID, Fname, Mname, Lname, Leaves FROM EMPLOYEE WHERE Leaves=(SELECT MAX(Leaves) FROM EMPLOYEE)";

?>