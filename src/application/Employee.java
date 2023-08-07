package application;

public class Employee {
	private String idEmployee ;
	private String nameEmployee;
	private String age;
	private String gender;
	private String Adress;
	private String phone;
	private String Email;
	private String password;
	private String rankEmp;
	public String getIdEmployee() {
		return idEmployee;
	}
	public void setIdEmployee(String idEmployee) {
		this.idEmployee = idEmployee;
	}
	public String getNameEmployee() {
		return nameEmployee;
	}
	public void setNameEmployee(String nameEmployee) {
		this.nameEmployee = nameEmployee;
	}
	public String getAge() {
		return age;
	}
	public void setAge(String age) {
		this.age = age;
	}
	public String getGender() {
		return gender;
	}
	public void setGender(String gender) {
		this.gender = gender;
	}
	public String getAdress() {
		return Adress;
	}
	public void setAdress(String adress) {
		Adress = adress;
	}
	public String getPhone() {
		return phone;
	}
	public void setPhone(String phone) {
		this.phone = phone;
	}
	public String getEmail() {
		return Email;
	}
	public void setEmail(String email) {
		Email = email;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getRankEmp() {
		return rankEmp;
	}
	public void setRankEmp(String rankEmp) {
		this.rankEmp = rankEmp;
	}
	public Employee(String idEmployee, String nameEmployee, String age, String gender, String adress, String phone,
			String email, String password, String rankEmp) {
		super();
		this.idEmployee = idEmployee;
		this.nameEmployee = nameEmployee;
		this.age = age;
		this.gender = gender;
		Adress = adress;
		this.phone = phone;
		Email = email;
		this.password = password;
		this.rankEmp = rankEmp;
	}
	
	public Employee(String idEmployee, String nameEmployee, String age, String gender, String adress, String phone,
			String email, String rankEmp) {
		super();
		this.idEmployee = idEmployee;
		this.nameEmployee = nameEmployee;
		this.age = age;
		this.gender = gender;
		Adress = adress;
		this.phone = phone;
		Email = email;
		this.rankEmp = rankEmp;
	}
	
	

}
