package application;

public class Donor {

	String idDowner;
	String name;
	String age;
	String gender;
	String bloodType;
	String helthIssues;
	String Email;
	String password;
	String Address;
	String phone;

	public Donor(String idDowner, String name, String age, String gender, String bloodType, String helthIssues,
			String Email, String password, String Address, String phone) {
		this.idDowner=idDowner;
		this.name =name;
		this.age=age;
		this.gender=gender;
		this.bloodType=bloodType;
		this.helthIssues=helthIssues;
		this.Email=Email;
		this.password=password;
		this.Address=Address;
		this.phone=phone;
	}

	public String getIdDowner() {
		return idDowner;
	}

	public void setIdDowner(String idDowner) {
		this.idDowner = idDowner;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
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

	public String getBloodType() {
		return bloodType;
	}

	public void setBloodType(String bloodType) {
		this.bloodType = bloodType;
	}

	public String getHelthIssues() {
		return helthIssues;
	}

	public void setHelthIssues(String helthIssues) {
		this.helthIssues = helthIssues;
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

	public String getAddress() {
		return Address;
	}

	public void setAddress(String address) {
		Address = address;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}

}
