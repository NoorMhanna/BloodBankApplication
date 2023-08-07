package application;

public class Stock {
	private String bloodType;
	private int unit;
	
	
	public Stock (String bloodType,int  unit) {
		this.bloodType=bloodType;
		this.unit=unit;
	}

	public String getBloodType() {
		return bloodType;
	}

	public void setBloodType(String bloodType) {
		this.bloodType = bloodType;
	}

	public int getUnit() {
		return unit;
	}

	public void setUnit(int unit) {
		this.unit = unit;
	}

	

}
