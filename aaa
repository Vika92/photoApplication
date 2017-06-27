import React, { Component } from 'react';
import Slider from 'react-slick';
import { MobileDropdownTabs, MobileDropdownTab } from '../../atoms/nav-tabs';

class NextArrow extends Component {
	render() {
		return <div {...this.props} className="btn btn-aquamarine sm arrow-right"></div>;
	}
}

class PrevArrow extends Component {
	render() {
		return <div {...this.props} className="btn btn-aquamarine sm arrow-left"></div>;
	}
}

const TagRoleLabel = ({ color, onClick, role }) => {
	return (
		<div
			className="badge double"
			style={{ backgroundColor: color }}
			onClick={() => {
				if (onClick) {
					onClick(role);
				}
			}}>
			<span className="bright">{role.label}</span>
			<span className="dark">{role.count}</span>
		</div>
	);
};

class TagRoles extends Component {
	constructor(props) {
		super(props);

		this.state = {
			role: 'All'
		};
	}

	generateTagRoles = () => {
		const { onRoleChanged, roles } = this.props;
		const { role: activeRole } = this.state;

		return Object.keys(roles)
			.map((tagRole, i) => {
				const role = roles[tagRole];
				const color = tagRole === activeRole.tagRole ? role.noteType.labelColor : '';
				return (
					<TagRoleLabel
						key={i + 1}
						color={color}
						role={role}
						onClick={() => {
							this.setState({ role });
							if (onRoleChanged) {
								onRoleChanged(role);
							}
						}} />
				);
			});
	}

	render() {
		const { onRoleChanged, roles, allCaseLength } = this.props;
		const { role } = this.state;
		const color = role === 'All' ? "#00d0be" : '';
		let count = window.innerWidth / 250;
		count = Math.floor(count);
		const settings = {
			arrows: true,
			infinite: false,
			speed: 500,
			prevArrow: <PrevArrow />,
			nextArrow: <NextArrow />,
			slidesToShow: count,
			slidesToScroll: count,
			variableWidth: true
		};

		return (
			<div>
				<MobileDropdownTabs>
					<MobileDropdownTab>
						<div className="badge double red">
							<span className="bright">FOUNDER OF</span>
							<span className="dark">{roles.length}</span>
						</div>
					</MobileDropdownTab>
					{this.generateTagRoles().map((child, index) =>
						<MobileDropdownTab key={index}>{child}</MobileDropdownTab>)}
				</MobileDropdownTabs>
				<div className="dropdown-tabs about-header-badge">
					<Slider {...settings}>
						<div
							className="badge double"
							style={{ backgroundColor: color, display: 'inline-flex' }}
							onClick={() => {
								this.setState({ role: 'All' });
								if (onRoleChanged) {
									onRoleChanged('All');
								}
							}}>
							<span className="bright">All</span>
							{
                allCaseLength ? (<span className="dark badge-all">{allCaseLength}</span>) : ''
							}
						</div>
						{this.generateTagRoles()}
					</Slider>
				</div>
			</div>
		);
	}
}

export default TagRoles;
